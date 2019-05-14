<?php

namespace App\Http\Controllers;

use App\Models\bookings;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class HomeController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home')->with(['controller' => $this]);
    }

    public function indexReports(Request $request)
    {
        $bookings = bookings::orderBy('id', 'DESC');

        //if ($request["from"] == '' and $request["to"] == '' and $request["status"] == '') {
        $from = Carbon::parse($request["from"] . ' 23:59:59');
        $from = $from->subDay();
        $to = Carbon::parse($request["to"] . ' 00:00:00');
        $to = $to->addDay();


        //just from
        if ($request["from"] != '' and $request["to"] == '') {
            $bookings = $bookings->whereDate('startDateTime', '>=', $from);
        }

        //just to
        if ($request["from"] == '' and $request["to"] != '') {
            $bookings = $bookings->whereDate('startDateTime', '<=', $to);
        }

        //form and to
        if ($request["from"] != '' and $request["to"] != '') {
            $bookings = $bookings->whereBetween('startDateTime', [$from, $to]);
        }

        if ($request["status"] != '') {
            $bookings = $bookings->where('status', '=', $request["status"]);
        }

        $searched_bookings_count = $bookings;
        $searched_bookings_count = $searched_bookings_count->count();
        $bookings = $bookings->paginate(20);

        $todayBookings = bookings::whereDate('startDateTime', Carbon::today())->where('status', 'approved')->orderBy('id', 'DESC')->get();

        $tomorrowBookings = bookings::whereDate('startDateTime', Carbon::tomorrow())->where('status', '!=', 'canceled')->orderBy('id', 'DESC')->get();

        $monthBookingsCount = bookings::whereDate('startDateTime', '>=', Carbon::today()->subMonths(1))->where('status', 'approved')->count();
        $totalBookingsCount = bookings::count();
        $canceledBookingsCount = bookings::where('status', 'canceled')->count();
        return view('reports.index', compact('bookings', 'tomorrowBookings', 'searched_bookings_count', 'todayBookings', 'monthBookingsCount', 'totalBookingsCount', 'canceledBookingsCount'))->with(['controller' => $this]);
    }

    public function getTime($dateTime)
    {
        $startDateTime = Carbon::parse($dateTime);
        $get_time = $startDateTime->format('h:i:s a');
        return $get_time;
    }

    public function convertTimeToString($date_time)
    {
        $new_string = Carbon::parse($date_time);
        return $new_string->format('D d-F-Y g:i A');
    }

}
