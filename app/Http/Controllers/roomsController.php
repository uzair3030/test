<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateroomsRequest;
use App\Http\Requests\UpdateroomsRequest;
use App\Repositories\roomsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Routing\Controller as BaseController;
use App\Models\rooms;
use App\Models\prices;
use App\Models\bookings;
use Illuminate\Support\Facades\App;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Models\settings;
use Illuminate\Support\Facades\DB;


class roomsController extends BaseController
{
    /** @var  roomsRepository */
    private $roomsRepository;

    public function __construct(roomsRepository $roomsRepo)
    {
        $this->roomsRepository = $roomsRepo;
    }

    public function rooms()
    {
        $rooms = rooms::whereIn('status', ['active', 'pending'])->get();
        return view('home.rooms')->with('rooms', $rooms);
    }

    public function roomDetails($id)
    {
        $room = rooms::find($id);
        if (empty($room)) {
            Flash::error('Rooms not found');
            return back();
        }
        return view('home.roomDetails', compact('room'))->with(['controller' => $this, 'room_id' => $room->id]);
    }

    public function bookingStep1($id, $players, $date, $time)
    {  
       
        $dateTime = Carbon::parse(base64_decode($date) . " " . base64_decode($time));
        /*Start calculate deadline for paid*/
        $booking_date = $dateTime;
        $now = Carbon::now();
        $now->format('Y-m-d H:m:s');
        $now->setTimezone('Asia/Riyadh');
        $differ_hours = $now->diffInHours($booking_date);
        if ($differ_hours < 12) {
            $deadlineForPaid = $now->addHour(1);
            $deadlineForPaidDay = $deadlineForPaid->format('l');
        } elseif ($differ_hours <= 24 and $differ_hours >= 12) {
            $deadlineForPaid = $now->addHour(8);
            $deadlineForPaidDay = $deadlineForPaid->format('l');
        } else {
            $deadlineForPaid = $now->addHour(12);
            $deadlineForPaidDay = $deadlineForPaid->format('l');
        }
        /*End calculate deadline for paid*/
        setlocale(LC_ALL, 'ar_SA');
        Carbon::setLocale('ar');
        $rooms = rooms::find($id);
      
        if (!$rooms) {
            Flash::error('Rooms not found');
            return back();
        }
        /*if (\DHalper::isWeekend(base64_decode($date))) {
            //check if there are related prices
            if (count($rooms->prices)) {
                $total = $rooms->prices()->where('players', base64_decode($players))->first()->weekendPrice;
            } else {
                $total = $rooms->prices()->where('players', base64_decode($players))->first()->price;
            }
        } else {*/
        $total = $rooms->prices()->where('players', base64_decode($players))->first()->price;
        /*}*/

        $data = [
            "total" => $total,
            "room" => $rooms,
            "pl" => base64_decode($players),
            "date" => $dateTime->formatLocalized('%A %d %B %Y'),
            "time" => $dateTime->formatLocalized('%I:%M %p'),
            "timeTill" => now()->addYear()->diffForHumans(),
            "deadlineForPaid" => $deadlineForPaid,
            "deadlineForPaidDay" => $deadlineForPaidDay

        ];
      
       
        return view('home.bookingFinal')->with(['data' => $data, 'controller' => $this]);

    }

    public function finalBooking(Request $request)
    { 
       
        $client_ip = $request->ip();
        //check if ip is blocked
        if (self::isBlocked($client_ip)) {
            if (App::getLocale() == 'ar') {
                return back()->with('danger', 'نعتذر عن تقديم الخدمة في الوقت الحالي.');
                //Flash::error('جميع الحقول مطلوبة');
            } else {
                return back()->with('danger', 'Sorry,service is not available at this time.');
                //Flash::error('All fields required');
            }
        }

        $validator = Validator::make($request->all(), [
            'date' => ['required'],
            'time' => ['required'],
            'pl' => ['required', 'integer', 'min:2'],
            'phone' => ['required', 'regex:/^(05)(5|0|3|6|4|9|1|8|7)([0-9]{7})$/'],
            'name' => ['required'],
            /*'email' => ['required', 'email'],*/
            'room_id' => ['required'],
            'deadlineForPaid' => ['required'],
        ]);

        if ($validator->fails()) {
            if (App::getLocale() == 'ar') {
                return back()->with('danger', 'جميع الحقول مطلوبة');
                //Flash::error('جميع الحقول مطلوبة');
            } else {
                return back()->with('danger', 'All fields required');
                //Flash::error('All fields required');
            }
            //return back();
        }
        $dateTime = Carbon::parse($request->date . " " . $request->time);
        if (self::isHoliday($dateTime)) {
            if (App::getLocale() == 'ar') {
                return back()->with('danger', 'اليوم المحدد عطلة للفندق');
                //Flash::error('اليوم المحدد عطلة للفندق');
            } else {
                return back()->with('danger', 'Requested Day is a hotel holiday');
                //Flash::error('Requested Day is a hotel holiday');
            }
            //return back();
        }
        $rooms = rooms::find($request->room_id);
       
       
        if (!$rooms) {
            if (App::getLocale() == 'ar') {
                return back()->with('danger', 'الغرف المطلوبة غير موجودة');
                //Flash::error('الغرف المطلوبة غير موجودة');
            } else {
                return back()->with('danger', 'Requested Rooms not found');
                //Flash::error('Requested Rooms not found');
            }
            //return back();
        }

        //check duplicated booking
       
        $find_booking = bookings::where('startDateTime', '=', $dateTime)->where('room_id', '=', $request->room_id)->whereIn('status', ['pending', 'approved'])->first();
       
       if ($find_booking) {
            if (App::getLocale() == 'ar') {
                //Flash::error('الموعد المحدد محجوز مسبقاً');
                return back()->with('danger', 'الموعد المحدد محجوز مسبقاً');
            } else {
                return back()->with('danger', 'The appointment is already booked');
                //Flash::error('The appointment is already booked');
            }
            //return back();
        }

        //check if

        if ($rooms->number == 7) {
            $validator = Validator::make($request->all(), [
                'pl' => ['max:8'],
            ]);

            if ($validator->fails()) {
                if (App::getLocale() == 'ar') {
                    return back()->with('danger', 'جميع الحقول مطلوبة');
                    //Flash::error('جميع الحقول مطلوبة');
                } else {
                    return back()->with('danger', 'All fields required');
                    //Flash::error('All fields required');
                }
                //return back();
            }
        }

        if ($rooms->number == 13) {
            $validator = Validator::make($request->all(), [
                'pl' => ['max:6'],
            ]);

            if ($validator->fails()) {
                if (App::getLocale() == 'ar') {
                    return back()->with('danger', 'جميع الحقول مطلوبة');
                    //Flash::error('جميع الحقول مطلوبة');
                } else {
                    return back()->with('danger', 'All fields required');
                    //Flash::error('All fields required');
                }
            }
        }

        if ($rooms->number == 19) {
            $validator = Validator::make($request->all(), [
                'pl' => ['max:10'],
            ]);

            if ($validator->fails()) {
                if (App::getLocale() == 'ar') {
                    return back()->with('danger', 'جميع الحقول مطلوبة');
                    //Flash::error('جميع الحقول مطلوبة');
                } else {
                    return back()->with('danger', 'All fields required');
                    //Flash::error('All fields required');
                }
            }
        }
        $total = $rooms->prices()->where('players', $request->pl)->first()->price;
        /*Start calculate deadline for paid*/
        $booking_date = $dateTime;
        /*        return $booking_date;*/
        $now = Carbon::now();
        $now->format('Y-m-d H:m:s');
        $now->setTimezone('Asia/Riyadh');
        $differ_hours = $now->diffInHours($booking_date);
        if ($differ_hours < 12) {
            $deadlineForPaid = $now->addHour(1);
        } elseif ($differ_hours <= 24 and $differ_hours >= 12) {
            $deadlineForPaid = $now->addHour(8);
        } else {
            $deadlineForPaid = $now->addHour(12);
        }
        $startDateTime = Carbon::parse($request->date . " " . $request->time);
        $endDateTime = $dateTime->addMinutes(self::getRoomSettings($rooms->id, "durationOfRoomReservation"));
        $new_booking = bookings::create([
            "room_id" => $request->room_id,
            "startDateTime" => $startDateTime,
            "endDateTime" => $endDateTime,
            "customerName" => $request->name,
            /*            "customerEmail" => $request->email,*/
            "customerMobile" => $request->phone,
            "players" => $request->pl,
            "total" => $total * $request->pl,
            "status" => 'pending',
            "customerLang" => $this->lang(),
            "deadlineForPaid" => $deadlineForPaid,
            "ip" => $client_ip
        ]);

        $number_with_country_code = preg_replace('/^0/', '966', $new_booking->customerMobile);
        if ($new_booking->customerLang == 'ar') {
            $msg = 'تم إستلام تفاصيل حجزكم بنجاح. نأمل المبادرة بدفع المبلغ ليتم التأكيد.';
            //send a sms message
            self::sendSMSNotification($number_with_country_code, $msg);
            //send an email
            //self::sendEmailNotification($new_booking->customerName, $new_booking->customerEmail, $msg);
        } else {
            $msg = 'Dear guest, Your reservation details have been successfully received. Kindly purchase to confirm.';
            //send a sms message
            self::sendSMSNotification($number_with_country_code, $msg);
            //send an email
            //self::sendEmailNotification($new_booking->customerName, $new_booking->customerEmail, $msg);
        }

        //send an email to admin54
        $get_admin_email = self::getSystemSetting('adminNotificationEmail');
        //$msg = 'A new booking has been created, Details: booking #' . $new_booking->id . ', from: ' . $new_booking->customerName . ', phone:' . $new_booking->customerMobile . ', email:' . $new_booking->customerEmail . ', date time: from ' . $new_booking->startDateTime . ' to: ' . $new_booking->endDateTime . ' and deadline for paid: ' . $new_booking->deadlineForPaid . ' .';
        $msg = 'A new booking has been created, Details: booking #' . $new_booking->id . ', from: ' . $new_booking->customerName . ', phone:' . $new_booking->customerMobile . ', Slot time: from ' . $new_booking->startDateTime . ' to: ' . $new_booking->endDateTime . ' and deadline for paid: ' . $new_booking->deadlineForPaid . ' .';
        self::sendEmailNotification("The Escape Hotel", $get_admin_email, $msg);

        //redirect to successfully sent.
        return redirect('thanks');
    }

    public function thanks(){
        return view('home.thankyou');
    }
    public static function getRoomSettings($room_id, $what)
    {
        $room_settings = Settings::where('room_id', '=', $room_id)->first();
        return $room_settings->$what;
    }

    public static function sendEmailNotification($customerName, $customerEmail, $msg)
    {
        if (App::getLocale() == "ar") {
            Mail::raw($msg, function ($message) use ($customerName, $customerEmail) {
                $message->to($customerEmail, 'To ' . $customerName)->subject('تم إستلام تفاصيل حجزكم بنجاح.');
                $message->from('thehotelescapeksa@gmail.com', 'فندق اسكيب');
            });
        } else {
            Mail::raw($msg, function ($message) use ($customerName, $customerEmail) {
                $message->to($customerEmail, 'To' . $customerName)->subject('Your reservation details have been successfully received.');
                $message->from('thehotelescapeksa@gmail.com', 'The Escape Hotel');
            });
        }

    }

    public function lang()
    {
        return App::getLocale();
    }

    public static function sendSMSNotification($destinations, $msg, $sender = "EscapeHotel")
    {
        $client = new Client(); //GuzzleHttp\Client
        $headers = ['Content-type' => 'text/plain; charset=utf-8'];

        $result = $client->get("https://www.jawalbsms.ws/api.php/sendsms?user=theescapehotel&pass=Theescapehotel@1234&to=$destinations&message=$msg&sender=$sender", ['headers' => $headers]);
        return $result->getStatusCode();
    }

    public function gusts()
    {
        return view('home.gusts');
    }

    public function rules()
    {
        if (App::getLocale() == "ar") {
            return view('home.rules_ar');
        } else {
            return view('home.rules');
        }
    }

    public function contactUS()
    {
        return view('home.contactUs')->with(['controller' => $this]);
    }

    public function reserve(Request $request)
    { 
        $roomss = rooms::where('status', '=', 'active')->get();
      
        if ($request->room) {
            $rooms = rooms::find($request->room);
            if (empty($rooms)) {
                Flash::error('Rooms not found');
                return back();
            }
            return view('home.booking')->with(['room_id' => $request->room, 'rooms' => $roomss, 'chosenRoom' => $rooms, 'controller' => $this]);
        }

        return view('home.booking')->with(['rooms' => $roomss, 'controller' => $this]);
    }

    /**
     * Display a listing of the rooms.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->roomsRepository->pushCriteria(new RequestCriteria($request));
        $rooms = $this->roomsRepository->all();

        return view('rooms.index')
            ->with('rooms', $rooms);
    }

    /**
     * Show the form for creating a new rooms.
     *
     * @return Response
     */
    public function create()
    {
        return view('rooms.create');
    }

    /**
     * Store a newly created rooms in storage.
     *
     * @param CreateroomsRequest $request
     *
     * @return Response
     */
    public function store(CreateroomsRequest $request)
    {
        $input = $request->all();
        if ($request->has('image')) {
            $image = $request->file('image');
            $filename = 'ID-' . time() . rand(1000000, 9999999) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('uploads/');
            $image->move($destinationPath, $filename);
            $input['image'] = 'uploads/' . $filename;
        }

        if ($request->has('image_en')) {
            $image = $request->file('image_en');
            $filename = 'ID-' . time() . rand(1000000, 9999999) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('uploads/');
            $image->move($destinationPath, $filename);
            $input['image_en'] = 'uploads/' . $filename;
        }

        if ($request->has('image1')) {
            $image = $request->file('image1');
            $filename = $request->user()->id . '-ID-' . time() . rand(1000000, 9999999) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('uploads/');
            $image->move($destinationPath, $filename);
            $input['image1'] = $filename;
        }

        if ($request->has('image2')) {
            $image = $request->file('images');
            $filename = $request->user()->id . '-ID-' . time() . rand(1000000, 9999999) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('uploads/');
            $image->move($destinationPath, $filename);
            $input['image2'] = $filename;
        }


        if ($request->has('image3')) {
            $image = $request->file('images');
            $filename = $request->user()->id . '-ID-' . time() . rand(1000000, 9999999) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('uploads/');
            $image->move($destinationPath, $filename);
            $input['image3'] = $filename;
        }


        $rooms = $this->roomsRepository->create($input);

        Flash::success('Rooms saved successfully.');

        return redirect(route('rooms.index'));
    }

    /**
     * Display the specified rooms.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $rooms = $this->roomsRepository->findWithoutFail($id);

        if (empty($rooms)) {
            Flash::error('Rooms not found');

            return redirect(route('rooms.index'));
        }

        return view('rooms.show')->with('rooms', $rooms);
    }

    /**
     * Show the form for editing the specified rooms.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $rooms = $this->roomsRepository->findWithoutFail($id);
        $prices = prices::where('room_id', $id)->get();;

        if (empty($rooms)) {
            Flash::error('Rooms not found');

            return redirect(route('rooms.index'));
        }

        return view('rooms.edit')->with('rooms', $rooms)->with('prices', $prices);
    }

    /**
     * Update the specified rooms in storage.
     *
     * @param  int $id
     * @param UpdateroomsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateroomsRequest $request)
    {
        $rooms = $this->roomsRepository->findWithoutFail($id);

        if (empty($rooms)) {
            Flash::error('Rooms not found');

            return redirect(route('rooms.index'));
        }
        $input = $request->all();


        if ($request->has('image')) {
            $image = $request->file('image');
            $filename = $rooms->id . '-ID-' . time() . rand(1000000, 9999999) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('uploads/');
            $image->move($destinationPath, $filename);
            $input['image'] = 'uploads/' . $filename;
        }

        if ($request->has('image_en')) {
            $image = $request->file('image_en');
            $filename = $rooms->id . '-ID-' . time() . rand(1000000, 9999999) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('uploads/');
            $image->move($destinationPath, $filename);
            $input['image_en'] = 'uploads/' . $filename;
        }

        if ($request->has('image1')) {
            $image = $request->file('image1');
            $filename = $rooms->id . '-ID-' . time() . rand(1000000, 9999999) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('uploads/');
            $image->move($destinationPath, $filename);
            $input['image1'] = $filename;
        }

        if ($request->has('image2')) {
            $image = $request->file('image2');
            $filename = $rooms->id . '-ID-' . time() . rand(1000000, 9999999) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('uploads/');
            $image->move($destinationPath, $filename);
            $input['image2'] = $filename;
        }


        if ($request->has('image3')) {
            $image = $request->file('image3');
            $filename = $rooms->id . '-ID-' . time() . rand(1000000, 9999999) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('uploads/');
            $image->move($destinationPath, $filename);
            $input['image3'] = $filename;
        }

        $rooms = $this->roomsRepository->update($input, $id);

        Flash::success('Rooms updated successfully.');

        return redirect(route('rooms.index'));
    }

    /**
     * Remove the specified rooms from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $rooms = $this->roomsRepository->findWithoutFail($id);

        if (empty($rooms)) {
            Flash::error('Rooms not found');

            return redirect(route('rooms.index'));
        }

        $this->roomsRepository->delete($id);

        Flash::success('Rooms deleted successfully.');

        return redirect(route('rooms.index'));
    }

    public function translateDateTime($en_date_time)
    {
        if (App::getLocale() == 'ar') {
            $standard = array("am", "pm", "AM", "PM");
            $eastern_arabic_symbols = array("صباحاً", "مساءاً", "صباحاً", "مساءاً");
            $translated_time = str_replace($standard, $eastern_arabic_symbols, $en_date_time);

            $standard_months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
            $eastern_arabic_symbols_months = array("يناير", "فبراير", "مارس", "أبريل", "مايو", "يونيو", "يوليو", "أغسطس", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر");
            $date_with_arabic_month = str_replace($standard_months, $eastern_arabic_symbols_months, $translated_time);

            $standard_days = array("Saturday", "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday");
            $eastern_arabic_symbols_days = array("السبت", "الأحد", "الإثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة");
            return str_replace($standard_days, $eastern_arabic_symbols_days, $date_with_arabic_month);
        }

        //english
        return $en_date_time;

    }

    public function translateTime($en_time)
    {
        if (App::getLocale() == 'ar') {
            $standard = array("am", "pm", "AM", "PM");
            $eastern_arabic_symbols = array("صباحاً", "مساءاً", "صباحاً", "مساءاً");
            return str_replace($standard, $eastern_arabic_symbols, $en_time);
        }
        //english
        return $en_time;


    }

    public function translateDate($en_date)
    {
        if (App::getLocale() == 'ar') {

            $standard_months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
            $eastern_arabic_symbols_months = array("يناير", "فبراير", "مارس", "أبريل", "مايو", "يونيو", "يوليو", "أغسطس", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر");
            $date_with_arabic_month = str_replace($standard_months, $eastern_arabic_symbols_months, $en_date);


            $standard_days = array("Saturday", "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday");
            $eastern_arabic_symbols_days = array("السبت", "الأحد", "الإثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة");
            return str_replace($standard_days, $eastern_arabic_symbols_days, $date_with_arabic_month);
        }
        //english
        return $en_date;
    }

    public function translateDay($en_day)
    {
        if (App::getLocale() == 'ar') {
            $standard_days = array("Saturday", "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday");
            $eastern_arabic_symbols_days = array("السبت", "الأحد", "الإثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة");
            return str_replace($standard_days, $eastern_arabic_symbols_days, $en_day);
        }
        //english
        return $en_day;
    }

    public function arabicDay($en_day)
    {
        $standard_days = array("Saturday", "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday");
        $eastern_arabic_symbols_days = array("السبت", "الأحد", "الإثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة");
        return str_replace($standard_days, $eastern_arabic_symbols_days, $en_day);
    }

    public function minusTwoHours($time)
    {
        $time = Carbon::parse($time);
        return $time->subHours(2)->formatLocalized('%I:%M %p');
    }

    public function convertTimeToString($date_time)
    {
        if (App::getLocale() == 'ar') {
            return $date_time->format('d-F-Y g:i A');
        }

        return $date_time->format('Y-F-d g:i A');
    }

    public function sendEmail()
    {
        self::sendEmailNotification('Test', 'ahmed.i.madhoun@gmail.com', 'test');
    }

    public static function isHoliday($date)
    {
        $dateToCheck = Carbon::parse($date)->format('l');

        $holiday = DB::table('system_settings')
            ->where('code', '=', 'holiday')
            ->where('content', '=', $dateToCheck)
            ->first();
        if ($holiday)
            return true;
        return false;
    }

    public static function getSystemSetting($what)
    {
        $system_setting = DB::table('system_settings')
            ->where('code', '=', $what)
            ->first();
        return $system_setting->content;
    }

    public function welcome()
    {
        return view('welcome')->with(['controller' => $this]);
    }

    public static function isBlocked($ip)
    {
        $blocked_ip = DB::table('blocked_ips')
            ->where('ip', '=', $ip)
            ->where('deleted_at', '=', null)
            ->first();
        if ($blocked_ip)
            return true;
        return false;
    }
}
