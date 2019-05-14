@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Bookings</h1>
        <h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px"
               href="{!! route('bookings.create') !!}">Add New</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <form action="/admin/bookings" method="GET">
                            <div class="row">
                                <form action="{{route('reports.index')}}" method="GET">
                                    <div class="col-md-3 col-sm-12 form-group"
                                         title="Search by booking Number or Mobile . . .">
                                        <input type="text" value="{{$q}}" name="q" class="form-control"
                                               placeholder="Search by booking Number or Mobile . . .">
                                    </div>
                                    <div class="col-md-3 col-sm-12 form-group" title="Search by booking date . . .">
                                        <input id="datepicker" type="text" value="{{$booking_date}}" name="booking_date"
                                               class="form-control"
                                               placeholder="Search by booking date . . .">
                                    </div>
                                    <div class="col-md-3 col-sm-12 form-group">
                                        <select name="room_id" id="" class="form-control">
                                            <option @if($room_id == "") selected @endif value="">All Rooms</option>
                                            @foreach($all_rooms as $searched_room)
                                                <option @if($room_id == $searched_room->id) selected
                                                        @endif value="{{$searched_room->id}}">{{$searched_room->name_en}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-sm-12 form-group">
                                        <button type="submit" class="btn btn-primary">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            {{--<div id="imaginary_container">
                                <div class="input-group stylish-input-group">
Search by booking Number or Mobile . . .
                                    <input name="q" type="text" class="form-control" placeholder="">
                                    <span class="input-group-addon">
                                    <button type="submit">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                </span>
                                </div>
                            </div>--}}
                        </form>
                    </div>
                </div>
                @include('bookings.table')
                <div class="pagination">
                    {{$bookings->links()}}
                </div>
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{asset('css/booking.css')}}">
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function () {
            $("#datepicker").datepicker({
                dateFormat: "dd-mm-yy"
            });
        });
    </script>
@endsection

