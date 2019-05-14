


@extends('home.layout.app')

@section('content')
    <?php $counter = 0;
    if (isset($room_id)) {
        $avalibalSlots = \DHalper::getAvailableSlots($room_id);
    } else {
        $avalibalSlots = [];
    }

    ?>

    <!--hello start-->
    <section>
        <div class="container main-reserve">
            <form action="" id="myForm" onsubmit="return checkEver()">
                <div class="row booking">
                    <div class="col-xs-12">
                        <h4>@lang('rooms.Set your booking details below') :</h4>
                        <div class="form-group select-wrapper">
                            <select name="room" class="form-control form-control--shadow u-Rounded" id="dynamic_select">
                                <option>@lang('rooms.Select the room') </option>
                                @foreach ($rooms as $room )
                                    <option value="{{$room->id}}"
                                            @if (isset($room_id) and $room_id == $room->id )   selected @endif >
                                        @if (Session::get('locale') == "ar") {{$room->name}} @else  {{$room->name_en}} @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group select-wrapper select-parent">
                            @if (!empty($avalibalSlots) )
                                <select class="form-control form-control--shadow u-Rounded "
                                        onchange="selectPlayers(this)" required>
                                    <option>@lang('rooms.Select Number of Players') </option>
                                    @for ($i = 2 ; $i <= $chosenRoom->capacity ; $i ++ )
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            @else
                                <div class="disabled-select">
                                    <select
                                            class="form-control form-control--shadow u-Rounded" disabled>
                                        <option>@lang('rooms.Select Number of Players') </option>
                                    </select>
                                </div>
                                <div class="up-button">
                                    @if(App::getLocale() == 'ar')
                                        <button type="button" onclick="alert('اختر الغرفة أولاً')" class="form-control">
                                            غير مسموح
                                        </button>
                                    @else
                                        <button type="button" onclick="alert('Select room first')" class="form-control">
                                            Not
                                            Allowed
                                        </button>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <div class="form-group select-wrapper select-parent">
                            @if (!empty($avalibalSlots) )
                                <select class="form-control form-control--shadow u-Rounded" onchange="selectDate(this)"
                                        required>
                                    <option>@lang('rooms.Select the Date') </option>
                                    @foreach ($avalibalSlots as $date )
                                        <option value="{{ $date["date"]["value"] }}">{{ $date["date"]["localization_date"] }}</option>
                                    @endforeach
                                </select>
                            @else
                                <div class="disabled-select">
                                    <select onclick="alert(@lang('rooms.Select room first'))"
                                            class="form-control form-control--shadow u-Rounded" disabled>
                                        <option>@lang('rooms.Select the Date') </option>
                                    </select>
                                </div>
                                <div class="up-button">
                                    @if(App::getLocale() == 'ar')
                                        <button type="button" onclick="alert('اختر الغرفة أولاً')" class="form-control">
                                            غير مسموح
                                        </button>
                                    @else
                                        <button type="button" onclick="alert('Select room first')" class="form-control">
                                            Not
                                            Allowed
                                        </button>
                                    @endif
                                </div>
                            @endif
                        </div>

                    </div>
                    <div class="col-xs-12">
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
                                                   
                                                   
                                                        <td class="booked">
                                                            <span class="booking-time">{{ $controller->translateTime($slots['time']) }}</span>
                                                            <span class="booking-status"><img
                                                                        src="{{ asset('assets/imgs/booked.png') }}"
                                                                        alt=""></span>
                                                        </td>
                                                    @else

                                                 
                                                        <td data-slots="times" class="avas"
                                                            data-time="{{$slots['time']}}"
                                                            id='{{$date["date"]["value"]}}|{{$slots['time']}}'
                                                            style='cursor: pointer; background-color:black ;'
                                                            onclick="selectTime(event);">
                                                        <span class="booking-time" data-slots="times"
                                                              data-time="{{$slots['time']}}"
                                                              id='{{$date["date"]["value"]}}|{{$slots['time']}}'
                                                              style='cursor: pointer; '
                                                              onclick="selectTime(event);">{{ $controller->translateTime($slots['time']) }}</span>
                                                            <span class="booking-status" data-slots="times"
                                                                  data-time="{{$slots['time']}}"
                                                                  id='{{$date["date"]["value"]}}|{{$slots['time']}}'
                                                                  style='cursor: pointer;'
                                                                  onclick="selectTime(event);">@lang('rooms.Available') </span>
                                                        </td>
                                                        @endif
                                                    @endif
                                              
                                                @if ($counteer%4 == 0)
                                            </tr>
                                            @endif
                                            <?php $counteer++; ?>

                                            @endforeach
                                          

                                            {{-- <td>
                                                <span class="booking-time">--</span>
                                                <span class="booking-status"></span>
                                            </td> --}}

                                            </tr>
                                </table>
                                <div class="col-xs-12 text-center " id="reserverr">
                                    @if (Session::get('locale') == "ar")
                                        <input class="reserve" type="image"
                                               src="{{ asset('assets/imgs/reserve_button-ar.png') }} ">
                                    @else
                                        <input class="reserve" type="image"
                                               src="{{ asset('assets/imgs/reserve_button.png') }} ">
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        <p class="game-notice">@lang('rooms.* All games are private, only your team is allowed in the room, no strangers.') </p>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!--hello end-->


@endsection

@section('scripts')
    <script>

        $(function () {
            // bind change event to select
            $('#dynamic_select').on('change', function () {
                var url = $(this).val(); // get selected value
                if (url) { // require a URL
                    window.location = "/reserve?room=" + url; // redirect
                }
                return false;
            });
        });

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
            // document.getElementById( 'others' ).scrollIntoView();
            date = value;
            console.log(date);
        }

        var isOk = false;

        function selectTime(e) {
            if (numberOfPlayers === 0 || date === "") {
                alert("All Fildes Are Requried | جميع الحقول مطلوبة ");
                return;
            }
            var allSlots = document.getElementsByClassName('avas');

            Array.prototype.forEach.call(allSlots, function (el) {
                el.style.backgroundColor = "#000";
                console.log(el.tagName);
            });


            var target = e.target;
            document.getElementById(target.id).style.backgroundColor = "#6dbe14";
            document.getElementById("myForm").action = "/booking/" + "@if(isset($chosenRoom)){{$chosenRoom->id}}@else 1 @endif/" + window.btoa(numberOfPlayers) + "/" + window.btoa(date) + "/" + window.btoa(e.target.dataset.time);
            isOk = true;
            //document.getElementById("myForm").submit();
            console.log(document.getElementById('reserverr').style.display);
        }

        function checkEver(e) {
            if (!isOk) {
                alert("You to select Time . يجب عليك إختيار الوقت ");
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

    <script>

    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/booking.css') }} ">
@endsection



