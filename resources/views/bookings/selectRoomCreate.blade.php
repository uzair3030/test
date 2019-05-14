@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Bookings
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    <form action="{{url('admin/bookings/create/showRoomBookingDetails')}}" method="GET">
                        <!-- Room Id Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('room_id', 'Room:') !!}
                            <select required name="room_id" id="room_id" class="form-control">
                                @foreach($rooms as $room)
                                    <option value="{{$room->id}}">{{$room->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Submit Field -->
                        <div class="form-group col-sm-12">
                            <a href="{!! route('bookings.index') !!}" class="btn btn-default">Cancel</a>
                            <button type="submit" class="btn btn-success">Next <span class="fa fa-arrow-right"></span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
