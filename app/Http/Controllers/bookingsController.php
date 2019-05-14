<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatebookingsRequest;
use App\Http\Requests\UpdatebookingsRequest;
use App\Models\bookings;
use App\Repositories\bookingsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Routing\Controller as BaseController;
use App\Models\rooms;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;
use App\Models\settings;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class bookingsController extends BaseController
{
    /** @var  bookingsRepository */
    private $bookingsRepository;

    public function __construct(bookingsRepository $bookingsRepo)
    {
        $this->bookingsRepository = $bookingsRepo;
    }

    /**
     * Display a listing of the bookings.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $bookings = bookings::orderBy('id', 'DESC');
        //$this->bookingsRepository->pushCriteria(new RequestCriteria($request));
        if ($request["q"] != "") {
            $bookings = $bookings->where('id', 'LIKE', '%' . $request["q"] . '%')->orWhere('customerMobile', 'LIKE', '%' . $request["q"] . '%');
        }
        if ($request["booking_date"] != "") {
            //parse date
            $booking_date = Carbon::parse($request["booking_date"])->format('Y-m-d');
            $bookings = $bookings->whereDate('startDateTime', '=', $booking_date);
        }
        if ($request["room_id"] != "") {
            $bookings = $bookings->where('room_id', '=', $request["room_id"]);
        }
        $bookings = $bookings->paginate(20);

        //return all rooms to use it at search
        $all_rooms = rooms::where('status', '=', 'active')->get();

        return view('bookings.index')
            ->with(['controller' => $this, 'bookings' => $bookings, 'all_rooms' => $all_rooms, 'q' => $request["q"], 'booking_date' => $request["booking_date"], 'room_id' => $request["room_id"]]);
    }

    public function getRoomNameById($room_id)
    {
        $room = rooms::where('id', '=', $room_id)->first();
        if (!$room) {
            return $room_id;
        }
        return $room->name_en;
    }

    /**
     * Show the form for creating a new bookings.
     *
     * @return Response
     */
    public function create()
    {
        $rooms = rooms::where('status', '=', 'active')->get();
        return view('bookings.selectRoomCreate', compact('rooms'));
    }

    public function showRoomBookingDetails(Request $request)
    {
        $room = rooms::find($request["room_id"]);
        if (empty($room)) {
            Flash::error('Rooms not found');
            return back();
        }
        return view('bookings.create', compact('room'))->with(['controller' => $this, 'room_id' => $room->id]);
    }

    /**
     * Store a newly created bookings in storage.
     *
     * @param CreatebookingsRequest $request
     *
     * @return Response
     */
    public function store(CreatebookingsRequest $request)
    {
         $room = rooms::where('id', '=', $request["room_id"])->where('status', '=', 'active')->first();
        if (!$room) {
            Flash::warning('Requested room not found or not active :(');
            return redirect()->back();
        }

           $dateTime = Carbon::parse($request["day"] . " " . $request["booking_time"]);
        if (self::isHoliday($dateTime)) {
            Flash::error('Requested Day is a hotel holiday');
            return back();
        }

        //check duplicated booking
        $find_booking = bookings::where('startDateTime', '=', $dateTime)->where('room_id', '=', $request->room_id)->whereIn('status', ['pending', 'approved'])->first();
        
        if ($find_booking) {
            if (App::getLocale() == 'ar') {
                Flash::error('الموعد المحدد محجوز مسبقاً');
            } else {
                Flash::error('The appointment is already bookedً');
            }
            return back();
        }

        if ($room->number == 7) {
            $validator = Validator::make($request->all(), [
                'players' => ['max:8'],
            ]);

            if ($validator->fails()) {
                Flash::error('All fields required');
                return back();
            }
        }

        if ($room->number == 13) {
            $validator = Validator::make($request->all(), [
                'players' => ['max:6'],
            ]);

            if ($validator->fails()) {
                Flash::error('All fields required');
                return back();
            }
        }

        if ($room->number == 19) {
            $validator = Validator::make($request->all(), [
                'players' => ['max:10'],
            ]);

            if ($validator->fails()) {
                Flash::error('All fields required');
                return back();
            }
        }
        $total = $room->prices()->where('players', $request->players)->first()->price;
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
        $startDateTime = Carbon::parse($request->day . " " . $request->booking_time);
        $endDateTime = $dateTime->addMinutes(self::getRoomSettings($room->id, "durationOfRoomReservation"));
        bookings::create([
            "room_id" => $request->room_id,
            "startDateTime" => $startDateTime,
            "endDateTime" => $endDateTime,
            "customerName" => $request->customerName,
            /*"customerEmail" => $request->customerEmail,*/
            "customerMobile" => $request->customerMobile,
            "players" => $request->players,
            "total" => $total * $request->players,
            "status" => 'approved',
            "customerLang" => $this->lang(),
            "deadlineForPaid" => $deadlineForPaid
        ]);


        Flash::success('Bookings saved successfully.');

        return redirect(route('bookings.index'));
    }

    /**
     * Display the specified bookings.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $bookings = $this->bookingsRepository->findWithoutFail($id);

        if (empty($bookings)) {
            Flash::error('Bookings not found');

            return redirect(route('bookings.index'));
        }

        return view('bookings.show')->with(['bookings' => $bookings, 'controller' => $this]);
    }

    /**
     * Show the form for editing the specified bookings.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $bookings = $this->bookingsRepository->findWithoutFail($id);
        $rooms = rooms::pluck('name_en', 'id');

        if (empty($bookings)) {
            Flash::error('Bookings not found');

            return redirect(route('bookings.index'));
        }

        return view('bookings.edit')->with('bookings', $bookings)->with('rooms', $rooms);
    }

    /**
     * Update the specified bookings in storage.
     *
     * @param  int $id
     * @param UpdatebookingsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatebookingsRequest $request)
    {
        $bookings = $this->bookingsRepository->findWithoutFail($id);
        //check if status changed or not; then send notification by this

        if (empty($bookings)) {
            Flash::error('Bookings not found');

            return redirect(route('bookings.index'));
        }
        $requested_status = $request["status"];
        $current_status = $bookings->status;

        $bookings = $this->bookingsRepository->update($request->all(), $id);

        //update notes
        $bookings->notes = $request["notes"];
        $bookings->save();
        $number_with_country_code = preg_replace('/^0/', '966', $bookings->customerMobile);
        //send notification if status changed
        if ($requested_status != $current_status) {
            //send notification to customer
            if ($requested_status == "approved") {
                if ($bookings->customerLang == 'ar') {
                    $msg = 'ضيفنا العزيز،تم تأكيد حجزك نأمل الحضور قبل الموعد ب15 دقيقة.';
                    //send a sms message
                    self::sendSMSNotification($number_with_country_code, $msg);
                    //send an email
                    //self::sendEmailNotification($bookings->customerName, $bookings->customerEmail, $msg, 'تأكيد', $bookings->id);
                } else {
                    $msg = 'Dear Guest, Your reservation has been confirmed.Please arrive 15 minutes before your scheduled slot time.';
                    //send a sms message
                    self::sendSMSNotification($number_with_country_code, $msg);
                    //send an email
                    //self::sendEmailNotification($bookings->customerName, $bookings->customerEmail, $msg, 'confirmed', $bookings->id);
                }
            } else {
                if ($bookings->customerLang == 'ar') {
                    //$msg = 'ضيفنا العزيز، <br> تم إلغاء حجزك رقم ' . $bookings->id;
                    $msg = 'ضيفنا العزيز،تم إلغاء حجزك رقم' . $bookings->id;
                    //send a sms message
                    self::sendSMSNotification($number_with_country_code, $msg);
                    //send an email
                    //self::sendEmailNotification($bookings->customerName, $bookings->customerEmail, $msg, 'إلغاء', $bookings->id);
                } else {
                    $msg = 'Dear Guest, Your reservation #' . $bookings->id . ' has been canceled!';
                    //send a sms message
                    self::sendSMSNotification($number_with_country_code, $msg);
                    //send an email
                    //self::sendEmailNotification($bookings->customerName, $bookings->customerEmail, $msg, 'canceled', $bookings->id);
                }
            }
            //self::sendEmailNotification($bookings->customerEmail, $bookings->status);
        }
        Flash::success('Bookings updated successfully.');

        return redirect(route('bookings.index'));
    }

    public static function sendEmailNotification($customerName, $customerEmail, $msg, $type, $booking_id)
    {
        if (App::getLocale() == "ar") {
            Mail::raw($msg, function ($message) use ($customerName, $customerEmail, $type, $booking_id) {
                $message->to($customerEmail, 'To ' . $customerName)->subject('تم ' . $type . ' حجزك رقم ' . $booking_id . '.');
                $message->from('thehotelescapeksa@gmail.com', 'فندق اسكيب');
            });
        } else {
            Mail::raw($msg, function ($message) use ($customerName, $customerEmail, $type, $booking_id) {
                $message->to($customerEmail, 'To' . $customerName)->subject('Your reservation #' . $booking_id . ' has been ' . $type . '.');
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

    /**
     * Remove the specified bookings from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $bookings = $this->bookingsRepository->findWithoutFail($id);

        if (!$bookings) {
            Flash::error('Bookings not found');

            return redirect(route('bookings.index'));
        }

        $this->bookingsRepository->delete($id);

        Flash::success('Booking deleted successfully.');

        return redirect(route('bookings.index'));
    }

    public function cancelUnpaidBookings()
    {
        try {
            /*$now = Carbon::now();
            $now->format('Y-m-d H:m:s');
            bookings::where('deadlineForPaid', '<', $now)->where('status', 'pending')->update(['status' => 'canceled']);*/
            return "Operation successfully done";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function holiday()
    {
        $holiday = DB::table('system_settings')
            ->where('code', '=', 'holiday')
            ->first();
        return $holiday->content;
    }

    public function test(Request $request)
    {
        return "IP: " . $request->ip();
        /*//بدايته بتكون بتساوي بداية الستارد او قبلها  و نهايته بتكون بعد نهايته
        $startDateTime = Carbon::parse($startDateTime);
        $endDateTime = Carbon::parse($startDateTime)->addMinutes(60);
        $reservedCount = bookings::where('startDateTime', '<=', $startDateTime)
            ->where('endDateTime', '>=', $endDateTime)
            ->whereIn('status', ['pending', 'approved'])
            ->count();
        if ($reservedCount != 0)
            return 1;
        return 0;*/

        /*
          ;
          return $dateToCheck;*/
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

    public function getRoomDetails(Request $request)
    {
        $find_room = rooms::find($request->id);
        $room_settings = Settings::where('room_id', '=', $find_room->id)->first();
        $now = date('Y-m-d', time());
        $players = [];
        $capacity = $find_room->capacity;
        for ($x = 2; $x <= $capacity; $x++) {
            array_push($players, $x);
        }
        $data = [];
        $data["players"] = $players;
        $data["startDateTime"] = $now . ' ' . $room_settings->startWorkTime;
        $data["endDateTime"] = $now . ' ' . $room_settings->endWorkTime;
        return $data;
    }

    public static function getSystemSetting($what)
    {
        $system_setting = DB::table('system_settings')
            ->where('code', '=', $what)
            ->first();
        return $system_setting->content;
    }

    public static function getRoomSettings($room_id, $what)
    {
        $room_settings = Settings::where('room_id', '=', $room_id)->first();
        return $room_settings->$what;
    }

    public static function isBooked($startDateTime, $endDateTime, $room_id)
    {
        $startDateTime = Carbon::parse($startDateTime);
        $endDateTime = Carbon::parse($endDateTime);
        $reservedCount = bookings::where('startDateTime', '<', $endDateTime)
            ->where('endDateTime', '>', $startDateTime)
            ->where('room_id', '=', $room_id)
            ->whereIn('status', ['pending', 'approved'])
            ->count();

        if ($reservedCount != 0)
            return true;
        return false;

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
        $new_string = Carbon::parse($date_time);
        return $new_string->format('D d-F-Y g:i A');
    }

    public function deleteBookings(Request $request)
    {
        if (!isset($request["booking"])) {
            Flash::error('No bookings selected');

            return redirect(route('bookings.index'));
        }
        foreach ($request["booking"] as $booking) {
            $find_booking = $this->bookingsRepository->findWithoutFail($booking);
            if (!$find_booking) {
                Flash::error('Bookings not found');

                return redirect(route('bookings.index'));
            }

            $this->bookingsRepository->delete($booking);

        }

        Flash::success('Bookings deleted successfully.');

        return redirect(route('bookings.index'));
    }

    public function blockIp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ip' => ['required'],
        ]);

        if ($validator->fails()) {
            Flash::success('IP required.');
            return redirect(route('bookings.index'));
        }


        //check if ip blocked before
        $find_blocked = DB::table('blocked_ips')
            ->where('ip', '=', $request["ip"])
            ->where('deleted_at', '=', null)
            ->first();


        if (!$find_blocked) {
            //add new blocked ip
            $now = Carbon::now();
            $now->format('Y-m-d H:m:s');
            $now->setTimezone('Asia/Riyadh');

            DB::table('blocked_ips')->insert(
                ['ip' => $request["ip"], 'created_at' => $now, 'updated_at' => $now]
            );

            Flash::success('IP have been successfully added to blocked ips list.');

        } else {
            Flash::success('IP already exist in blocked ips list.');
        }

        return redirect(route('bookings.index'));
    }

    public function blockedIPs(Request $request)
    {
        $items = DB::table('blocked_ips')
            ->where('deleted_at', '=', null)
            ->orderBy('id', 'DESC');
        //$this->bookingsRepository->pushCriteria(new RequestCriteria($request));
        if ($request["q"] != "") {
            $items = $items->where('ip', 'LIKE', '%' . $request["q"] . '%');
        }

        $items = $items->paginate(20);

        return view('blockedIPs.index')
            ->with(['controller' => $this, 'items' => $items, 'q' => $request["q"]]);
    }

    public function destroyBlockedIP(Request $request, $id)
    {
        $now = Carbon::now();
        $now->format('Y-m-d H:m:s');
        $now->setTimezone('Asia/Riyadh');

        $find_blocked = DB::table('blocked_ips')
            ->where('id', '=', $id)
            ->where('deleted_at', '=', null)
            ->first();


        if (!$find_blocked) {
            Flash::error('Blocked IP not found');

            return redirect(route('blockedIPs'));
        }

        DB::table('blocked_ips')->where('id', '=', $find_blocked->id)->update(['deleted_at' => $now]);


        Flash::success('Blocked IP deleted successfully.');

        return redirect(route('blockedIPs'));
    }
}
