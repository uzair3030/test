@extends('layouts.app')

@section('content')
    <section class="content">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-calendar-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Today's Bookings</span>
                        <span class="info-box-number">{{ $todayBookings->count() }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yello"><i class="fa fa-calendar"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Month's Bookings</span>
                        <span class="info-box-number">{{ $monthBookingsCount }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-book"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Bookings</span>
                        <span class="info-box-number">{{ $totalBookingsCount }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-times-circle"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Canceled Bookings</span>
                        <span class="info-box-number">{{ $canceledBookingsCount }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->


        <!-- TABLE: Today Bookings -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Approved Today's Bookings ({{$todayBookings->count()}})</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Booking Number</th>
                            <th>Customer Name</th>
                            <th>Customer Mobile</th>
                            <th>Grand Total
                                <small>SAR</small>
                            </th>
                            <th>Time</th>
                            <th>Room</th>
                            <th>Deadline For Paid</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($todayBookings as $booking)
                            <tr>
                                <td><a href="{{url('admin/bookings/'.$booking->id)}}">{{$booking->id}}</a></td>
                                <td>{{$booking->customerName}}</td>
                                <td>{{$booking->customerMobile}}</td>
                                <td>{{$booking->total}}</td>
                                <td>{{$controller->getTime($booking->startDateTime)}}</td>
                                <td>{{$booking->room->name_en}}</td>
                                <td>{{$controller->convertTimeToString($booking->deadlineForPaid)}}</td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                <a href="/admin/bookings" class="btn btn-sm btn-default btn-flat pull-right">View All Bookings</a>
            </div>
            <!-- /.box-footer -->
        </div>

        <!-- TABLE: Tomorrow Bookings -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Tomorrow's Bookings ({{$tomorrowBookings->count()}})</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Booking Number</th>
                            <th>Customer Name</th>
                            <th>Customer Mobile</th>
                            <th>Grand Total
                                <small>SAR</small>
                            </th>
                            <th>Status</th>
                            <th>Time</th>
                            <th>Room</th>
                            <th>Deadline For Paid</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($tomorrowBookings as $booking)
                            <tr>
                                <td><a href="{{url('admin/bookings/'.$booking->id)}}">{{$booking->id}}</a></td>
                                <td>{{$booking->customerName}}</td>
                                <td>{{$booking->customerMobile}}</td>
                                <td>{{$booking->total}}</td>
                                <td>
                                    @if($booking->status == "approved")
                                        <span class="label label-success">{{$booking->status}}</span>
                                    @elseif($booking->status == "pending")
                                        <span class="label label-default">{{$booking->status}}</span>
                                    @else
                                        <span class="label label-danger">{{$booking->status}}</span>
                                    @endif
                                </td>
                                <td>{{$controller->getTime($booking->startDateTime)}}</td>
                                <td>{{$booking->room->name_en}}</td>
                                <td>{{$controller->convertTimeToString($booking->deadlineForPaid)}}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                <a href="/admin/bookings" class="btn btn-sm btn-default btn-flat pull-right">View All Bookings</a>
            </div>
            <!-- /.box-footer -->
        </div>

        <!-- TABLE: LATEST ORDERS -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Bookings Reports ({{$searched_bookings_count}})</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <form action="{{route('reports.index')}}" method="GET">
                        <div class="col-md-3 col-sm-12 form-group">
                            <select name="status" id="" class="form-control">
                                <option value="">All Status</option>
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                                <option value="canceled">Canceled</option>
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-12 form-group" title="From">
                            <input type="date" name="from" class="form-control">
                        </div>
                        <div class="col-md-3 col-sm-12 form-group" title="To">
                            <input type="date" name="to" class="form-control">
                        </div>
                        <div class="col-md-3 col-sm-12 form-group">
                            <button type="submit" class="btn btn-primary">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Booking Number</th>
                            <th>Customer Name</th>
                            <th>Customer Mobile</th>
                            <th>Grand Total
                                <small>SAR</small>
                            </th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Room</th>
                            <th>Deadline For Paid</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($bookings as $booking)


                            <tr>
                                <td><a href="{{url('admin/bookings/'.$booking->id)}}">{{$booking->id}}</a></td>
                                <td>{{$booking->customerName}}</td>
                                <td>{{$booking->customerMobile}}</td>
                                <td>{{$booking->total}}</td>
                                <td>
                                    @if($booking->status == "approved")
                                        <span class="label label-success">{{$booking->status}}</span>
                                    @elseif($booking->status == "pending")
                                        <span class="label label-default">{{$booking->status}}</span>
                                    @else
                                        <span class="label label-danger">{{$booking->status}}</span>
                                    @endif
                                </td>
                                <td>{{$controller->convertTimeToString($booking->startDateTime)}}</td>
                                <td>{{$booking->room->name_en}}</td>
                                <td>{{$controller->convertTimeToString($booking->deadlineForPaid)}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="pagination">
                        {{$bookings->links()}}
                    </div>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                <a href="/admin/bookings" class="btn btn-sm btn-default btn-flat pull-right">View All Bookings</a>
            </div>
            <!-- /.box-footer -->
        </div>
        <!-- /.box -->
        </div>
        <!-- /.col -->


        </div>
    </section>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/booking.css')}}">
@endsection
