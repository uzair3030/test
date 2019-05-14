<?php

use Carbon\Carbon;
use Carbon\CarbonInterval;
use App\Models\bookings;
use App\Models\prices;
use App\Models\rooms;
use App\Models\settings;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;


class DHalper
{
    /*public static function sendSMS($numbers, $message, $sender = "0541777786", $source = "mobily")
    {
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client
        $result = $client->get("https://www.jawalbsms.ws/api.php/sendsms?user=ezhalha&pass=9435541&to=$numbers&message=$message&sender=$sender");
        return $this->result($result);
    }*/

    public static function getAvailableSlots($roomID)
    {
        $months = array(
            "Jan" => "يناير",
            "Feb" => "فبراير",
            "Mar" => "مارس",
            "Apr" => "أبريل",
            "May" => "مايو",
            "Jun" => "يونيو",
            "Jul" => "يوليو",
            "Aug" => "أغسطس",
            "Sep" => "سبتمبر",
            "Oct" => "أكتوبر",
            "Nov" => "نوفمبر",
            "Dec" => "ديسمبر"
        );

        //$room = rooms::find($roomID) ;
        $numberOfSlotsPerRoom = 30;
        $dateNow = Carbon::now();
        $count = 0;
        $dates = [];
        $room = rooms::find($roomID);
        while ($count < $numberOfSlotsPerRoom) {
            $newData = $dateNow;
            if (!self::isHoliday($dateNow)) {
                if (\DHalper::getLanguage() == 'ar') {
                    $dates[] = [
                        "date" => ["value" => $newData->format('Y-m-d'), "localization_date" => \DHalper::getArabicDateNumbers($newData->format('l d-' . $months[date('M')] . '-Y'))],
                        "prices" => $room->prices,
                        "times" => \DHalper::getTimesForEachDay($newData->format('Y-m-d'), $roomID)
                    ];
                } else {
                    $dates[] = [
                        "date" => ["value" => $newData->format('Y-m-d'), "localization_date" => $newData->format('l d-M-Y')],
                        "prices" => $room->prices,
                        "times" => \DHalper::getTimesForEachDay($newData->format('Y-m-d'), $roomID)
                    ];
                }
            }
            $count++;
            $newData->addDay();
        }

        return $dates;
    }

    public static function getTimesForEachDay($date, $roomID)
    {
        $dateNow = Carbon::now();
        $dateNow->format('Y-m-d');
        $startWorkTime = Carbon::parse(self::getRoomSettings($roomID, "startWorkTime"));
        $endWorkTime = Carbon::parse(self::getRoomSettings($roomID, "endWorkTime"));
        $dateToCheck = Carbon::parse($date);
        $room = rooms::find($roomID);
        $times = [];

        $count = 0;
        $final_slot_comparable = $endWorkTime->subMinutes(self::getRoomSettings($roomID, "durationOfRoomReservation"));
        while ($startWorkTime->addMinutes(self::getRoomSettings($roomID, "durationOfRoomReservation")) <= $final_slot_comparable) {
            if ($count == 0) {
                $newTime = $startWorkTime->subMinutes(self::getRoomSettings($roomID, "durationOfRoomReservation"));
            } else {
                $newTime = $startWorkTime->addMinutes(self::getRoomSettings($roomID, "breakTimeBetweenEachBooking"));
            }

            $CDate = Carbon::parse("$date " . $newTime->format('H:i'));
            /*$booking = bookings::where("room_id", $roomID)->whereIn('status', ['pending', 'approved'])
                ->where("startDateTime", $CDate)
                ->count();*/
            $now = Carbon::now();
            $now->format('Y-m-d H:m:s');
            $now->setTimezone('Asia/Riyadh');
            /*$after_tow_hours = $now->addHour(2);*/
            $theEarliestTimeToBook = $now->addMinutes(self::getSystemSetting('theEarliestTimeToBook'));

            if (!(self::isBooked($CDate, (self::getRoomSettings($roomID, "durationOfRoomReservation")), $roomID))) {
                if ($CDate->toDateTimeString() <= $theEarliestTimeToBook) {
                    $times[] = [
                        "time" => $newTime->format('h:i a'),
                        "avalibal" => true,
                        "hidden" => true,
                    ];
                } else {
                    $times[] = [
                        "time" => $newTime->format('h:i a'),
                        "avalibal" => true,
                        "hidden" => false,
                    ];
                }
            } else {
                if ($CDate->toDateTimeString() <= $theEarliestTimeToBook) {
                    $times[] = [
                        "time" => $newTime->format('h:i a'),
                        "avalibal" => false,
                        "hidden" => true,
                    ];
                } else {
                    $times[] = [
                        "time" => $newTime->format('h:i a'),
                        "avalibal" => false,
                        "hidden" => false,
                    ];
                }
            }
            $count++;

        }

        return $times;

    }

    public static function getRoomSettings($room_id, $what)
    {
        $room_settings = Settings::where('room_id', '=', $room_id)->first();
        return $room_settings->$what;
    }

    public static function getRandomRooms($number, $current_room_id)
    {
        //current room must not returned in results
        $room = rooms::inRandomOrder()->limit($number)->where('status', '=', 'active')->where('id', '!=', $current_room_id)->get();
        return $room;
    }

    public static function isWeekend($date)
    {
        $dateToCheck = Carbon::parse($date);
        $dayIs = $dateToCheck->dayOfWeek;
        $theDayIsInDB = "";
        switch ($dayIs) {
            case (Carbon::SATURDAY) :
                return true;
                break;

            case (Carbon::SUNDAY) :
                return false;
                break;

            case (Carbon::MONDAY) :
                return false;
                break;

            case (Carbon::TUESDAY) :
                return false;
                break;

            case (Carbon::THURSDAY) :
                return true;
                break;

            case (Carbon::WEDNESDAY) :
                return false;
                break;

            case (Carbon::FRIDAY) :
                return true;
                break;
        }
    }

    public static function getLanguage()
    {
        return App::getLocale();
    }

    public static function getArabicDateNumbers($englishDateNumbers)
    {
        $days = array(
            "Saturday" => "السبت",
            "Sunday" => "الأحد",
            "Monday" => "الإثنين",
            "Tuesday" => "الثلاثاء",
            "Wednesday" => "الأربعاء",
            "Thursday" => "الخميس",
            "Friday" => "الجمعة",
        );
        $standard_days = array("Saturday", "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday");
        $eastern_arabic_symbols_days = array("السبت", "الأحد", "الإثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة");
        $standard = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
        $eastern_arabic_symbols = array("٠", "١", "٢", "٣", "٤", "٥", "٦", "٧", "٨", "٩");

        $arabic_time_digits = str_replace($standard, $eastern_arabic_symbols, $englishDateNumbers);
        return str_replace($standard_days, $eastern_arabic_symbols_days, $arabic_time_digits);

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

    public static function isBooked($startDateTime, $roomDuration, $room_id)
    {
        $startDateTime = Carbon::parse($startDateTime);
        $endDateTime = Carbon::parse($startDateTime)->addMinutes($roomDuration);
        $reservedCount = bookings::where('startDateTime', '<', $endDateTime)
            ->where('endDateTime', '>', $startDateTime)
            ->where('room_id', '=', $room_id)
            ->whereIn('status', ['pending', 'approved'])
            ->count();

        if ($reservedCount != 0)
            return true;
        return false;

    }

}