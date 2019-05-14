@extends('layouts.app')

@section('content')
    <section class="content">
    @if(Auth::user()->role == "admin")
        <!-- Info boxes -->
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Sales (SAR)</span>
                            <span class="info-box-number">{{ \App\Models\bookings::where('status','approved')->sum('total') }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-book"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Booking</span>
                            <span class="info-box-number">{{ \App\Models\bookings::where('status','approved')->count() }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="fa fa-building"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Rooms</span>
                            <span class="info-box-number">{{ \App\Models\rooms::count() }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Users</span>
                            <span class="info-box-number">{{ \App\User::count() }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <!-- fix for small devices only -->
                <div class="clearfix visible-sm-block"></div>
            </div>
            <!-- /.row -->
    @endif

    <!-- TABLE: LATEST ORDERS -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Latest Bookings</h3>

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
                            <th>Date</th>
                            <th>Room</th>
                            <th>Deadline For Paid</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach (\App\Models\bookings::orderBy('id','DESC')->get() as $booking)


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
    </section>
@endsection
