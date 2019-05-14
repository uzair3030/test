@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Bookings <span>/</span> <b> Room: {{$room->name_en}} #{{$room->number}}</b>
        </h1>
    </section>
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
    <section>
        <div class="container">
            <form action="{{url('admin/bookings')}}" method="POST" id="{{--myForm--}}" {{--onsubmit="return checkEver()"--}} >
                {{csrf_field()}}
                <div class="row booking">
                    <div class="form-group col-sm-11">
                        {!! Form::label('customerName', 'Customer Name:') !!}
                        {!! Form::text('customerName', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    </div>

                    <!-- Customeremail Field -->
                   {{-- <div class="form-group col-sm-11">
                        {!! Form::label('customerEmail', 'Customer Email:') !!}
                        {!! Form::email('customerEmail', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    </div>--}}

                    <!-- Customermobile Field -->
                    <div class="form-group col-sm-11">
                        {!! Form::label('customerMobile', 'Customer Mobile:') !!}
                        <input type="tel" class="form-control" placeholder="E.g: 05xxxxxxxx" name="customerMobile" required
                               maxlength="10" pattern=".{10,10}" title="E.g: 05xxxxxxxx">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-12">
                        <input type="text" name="room_id" value="{{$room->id}}" style="display: none">
                        <input type="text" id="booking_time" name="booking_time" value="" style="display: none">
                        <h4>@lang('rooms.Set your booking details below') :</h4>
                        <?php $avalibalSlots = \DHalper::getAvailableSlots($room->id); ?>
                        <div class="form-group select-wrapper">
                            <select autofocus class="form-control form-control--shadow u-Rounded " onchange="selectPlayers(this)"
                                    required style="width: 95%" name="players">
                                <option value="">@lang('rooms.Select Number of Players') </option>
                                @for ($i = 2 ; $i <= $room->capacity ; $i ++ )
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group select-wrapper">
                            <select class="form-control form-control--shadow u-Rounded" onchange="selectDate(this)"
                                    required style="width: 95%" name="day">
                                <option value="">@lang('rooms.Select the Date') </option>
                                @foreach ($avalibalSlots as $date )
                                    <option value="{{ $date["date"]["value"] }}">{{ $date["date"]["localization_date"] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-xs-11">
                        <h5 class='hidemein' style="display : none;"><strong>@lang('rooms.no slots for today')</strong>
                        </h5>
                        @foreach ($avalibalSlots as $date )
                            <div id="{{ $date["date"]["value"] }}" class='hidemein' style="display : none;">
                                <h5>@lang('rooms.Select the time slot on')
                                    <strong>{{ $date["date"]["localization_date"] }} :</strong></h5>
                                  
                                <table class="table">


                                    <?php
                                    $counteer = 1;
                                    $start='03:30';
                                    $end='20:00';
                                    ?>
                                   
                                    @foreach ($date["times"] as $slots )
                                    <?php $timechk=date("H:i", strtotime($slots['time'])) ?>
                     
                    
                                
                                        @if ($counteer%4 == 1)
                                            <tr>
                                                @endif
                                                @if($timechk >= $start && $timechk <= $end)
                                                
                                                    @else
                                                   
                                               
                                               
                                                    @if($slots['avalibal'] == false )
                                                 
                                        
                                                        <td class="booked" style="text-align: center;background-color: white">
                                                            <span class="booking-time">{{ $controller->translateTime($slots['time']) }} <span style='color: orangered;font-weight:bold' class='fa fa-ban'> BOOKED</span></span>
                                                            {{--<span class="booking-status"><img
                                                                        src="{{ asset('assets/imgs/booked.png') }}"
                                                                        alt=""></span>--}}
                                                        </td>
                                                    @else
                                                        <td data-slots="times" class="avas"
                                                            data-time="{{$slots['time']}}"
                                                            id='{{$date["date"]["value"]}}|{{$slots['time']}}'
                                                            style='cursor: pointer;background-color: rgb(60, 141, 188);color: white;font-weight: bold;text-align: center;'
                                                            onclick="selectTime(event);">
                                                        <span class="booking-time" data-slots="times"
                                                              data-time="{{$slots['time']}}"
                                                              id='{{$date["date"]["value"]}}|{{$slots['time']}}'
                                                              style='cursor: pointer; '
                                                              onclick="selectTime(event);">{{ $controller->translateTime($slots['time']) }}</span>
                                                            <span class="booking-status" data-slots="times"
                                                                  data-time="{{$slots['time']}}"
                                                                  id='{{$date["date"]["value"]}}|{{$slots['time']}}'
                                                                  style='cursor: pointer; '
                                                                  onclick="selectTime(event);"> @lang('rooms.Available') </span>
                                                        </td>
                                                        @endif

                                                    @endif
                                               

                                                @if ($counteer%4 == 0)
                                            </tr>
                                            @endif
                                            <?php $counteer++; ?>

                                            @endforeach
                                            <!-- <td data-slots="times" class="avas" data-time="01:00 am" id="{{$date["date"]["value"]}}|12:30 am" style="cursor: pointer; background-color: rgb(60, 141, 188); color: white; font-weight: bold; text-align: center;" onclick="selectTime(event);">
                                                        <span class="booking-time" data-slots="times" data-time="01:00 am" id="{{$date["date"]["value"]}}|12:30 am" style="cursor: pointer; " onclick="selectTime(event);">12:30 am</span>
                                                            <span class="booking-status" data-slots="times" data-time="01:00 am" id="{{$date["date"]["value"]}}|12:30 am" style="cursor: pointer; " onclick="selectTime(event);"> @lang('rooms.Available') </span>
                                                        </td>
                                                        <td data-slots="times" class="avas" data-time="02:00 am" id="{{$date["date"]["value"]}}|02:00 am" style="cursor: pointer; background-color: rgb(60, 141, 188); color: white; font-weight: bold; text-align: center;" onclick="selectTime(event);">
                                                        <span class="booking-time" data-slots="times" data-time="02:00 am" id="{{$date["date"]["value"]}}|02:00 am" style="cursor: pointer; " onclick="selectTime(event);">02:00 am</span>
                                                            <span class="booking-status" data-slots="times" data-time="02:00 am" id="{{$date["date"]["value"]}}|02:00 am" style="cursor: pointer; " onclick="selectTime(event);"> @lang('rooms.Available') </span>
                                                        </td> -->

                                            {{-- <td>
                                                <span class="booking-time">--</span>
                                                <span class="booking-status"></span>
                                            </td> --}}

                                            </tr>
                                </table>
                                {{--<div class="col-xs-12 " id="reserverr">


                                   --}}{{-- @if (Session::get('locale') == "ar")
                                        <input class="reserve" type="image"
                                               src="{{ asset('assets/imgs/reserve_button-ar.png') }} ">
                                    @else
                                        <input class="reserve" type="image"
                                               src="{{ asset('assets/imgs/reserve_button.png') }} ">
                                    @endif--}}{{--
                                    <button class="btn btn-primary" type="submit"><span class="fa fa-save"></span> Save</button>


                                </div>--}}
                            </div>
                        @endforeach

                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-12 ">
                        {{-- @if (Session::get('locale') == "ar")
                             <input class="reserve" type="image"
                                    src="{{ asset('assets/imgs/reserve_button-ar.png') }} ">
                         @else
                             <input class="reserve" type="image"
                                    src="{{ asset('assets/imgs/reserve_button.png') }} ">
                         @endif--}}
                        <button class="btn btn-primary" type="submit"><span class="fa fa-save"></span> Save</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
@section('scripts')
    <script>

        var numberOfPlayers = 0;
        var date = "";

        function selectPlayers(selectedPlayers) {
            var value = selectedPlayers.value;
            numberOfPlayers = value;
            console.log(numberOfPlayers);
        }

        function selectDate(selectObject) {
            var list = document.getElementsByClassName("hidemein");
            for (var i = 0; i < list.length; i++) {
                list[i].style.display = 'none';
            }
            var value = selectObject.value;
            document.getElementById(value).style.display = 'block';
            document.getElementById('others').scrollIntoView();
            date = value;
            console.log(date);
        }

        var isOk = false;

        function selectTime(e) {
           /* if (numberOfPlayers == 0 || date == "") {
                alert("All Fildes Are Requried | جميع الحقول مطلوبة ");
                return;
            }*/
            var allSlots = document.getElementsByClassName('avas');

            Array.prototype.forEach.call(allSlots, function (el) {
                el.style.backgroundColor = "rgb(60, 141, 188)";
                console.log(el.tagName);
            });


            var target = e.target;
            document.getElementById(target.id).style.backgroundColor = "rgb(38, 92, 123)";
            //set time
            $('#booking_time').val(e.target.dataset.time);
            isOk = true;

        }

        function checkEver(e) {
            if (!isOk) {
                alert("You have to select Time . يجب عليك إختيار الوقت ");
                return false;
            }
            return true;
        }

        function b64EncodeUnicode(str) {
            return btoa(encodeURIComponent(str).replace(/%([0-9A-F]{2})/g,
                function toSolidBytes(match, p1) {
                    return String.fromCharCode('0x' + p1);
                }));
        }

    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/roomDetails.css')}}">
@endsection
