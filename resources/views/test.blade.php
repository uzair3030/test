@extends('home.layout.app')

@section('content')




    <!--slider start-->
    <div class="swiper-container room-slider">
        <div class="swiper-wrapper">
            @if (isset($room->image1))
                <section class="swiper-slide ImageBackground ImageBackground--overlay" data-overlay="0"
                         data-scheme="dark" data-swiper-autoplay="200">
                    <div class="ImageBackground__holder">
                        <img src="{{ asset('uploads/'.$room->image1) }}" alt="...">
                    </div>
                </section>
            @endif

            @if (isset($room->image2))
                <section class="swiper-slide ImageBackground ImageBackground--overlay" data-overlay="0"
                         data-scheme="dark" data-swiper-autoplay="200">
                    <div class="ImageBackground__holder">
                        <img src="{{ asset('uploads/'.$room->image2) }}" alt="...">
                    </div>
                </section>
            @endif

            @if (isset($room->image3))
                <section class="swiper-slide ImageBackground ImageBackground--overlay" data-overlay="0"
                         data-scheme="dark" data-swiper-autoplay="200">
                    <div class="ImageBackground__holder">
                        <img src="{{ asset('uploads/'.$room->image3) }}" alt="...">
                    </div>
                </section>
            @endif


        </div>
        <!-- Add Arrows -->
        <div class="swiper-control swiper-button-next"></div>
        <div class="swiper-control swiper-button-prev"></div>
    </div>
    <!--slider end-->

    <!--hello start-->
    <section>
        <div class="container">
            <div class="row gray">
                <div class="col-md-12 col-sm-12">
                    <h3 class="nomgbm">@lang('rooms.room') <span
                                class="room-no">{{ ($room->number != "") ? $room->number : $room->id }}</span></php
                        artisan h3>
                        <div class="dark-h3"></div>
                        <h1 class="u-MarginTop5 u-MarginBottom30 room-title">{{ $room->name }}</h1>
                    {!!html_entity_decode($room->desc) !!}
                </div>
                <br>
                <div class="row room-video">
                    <div class="col-md-12">
                        {{-- https://www.youtube.com/embed/vXNn3oHLVzk?rel=0&amp;controls=0&amp;showinfo=0 --}}
                        <iframe width="100%" height="300" src="{{ $room->videoUrl }}" frameborder="0"
                                allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="room-spec">
                            <span><strong>@lang('rooms.Age'):</strong> {{ $room->age }} </span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="room-spec">
                            <span><strong>@lang('rooms.Category'):</strong> {{ $room->category }} </span>
                        </div>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="room-spec">
                            <span><strong>@lang('rooms.Capacity')
                                    :</strong> 2 - {{ $room->capacity }} @lang('rooms.Victims') </span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="room-spec">
                            <span><strong>@lang('rooms.Duration')
                                    :</strong> {{ $room->duration }}  @lang('rooms.Mins')</span>
                        </div>
                    </div>

                </div>
                @if($room->live_performance_room)
                    <div class="row text-center live">
                        <div class="col-xs-7 col-xs-offset-2"><p> @lang('rooms.liveperformanceroom') </p></div>
                        <div class="col-xs-2 live-img"><img src="{{ asset('assets/imgs/live-per.png') }}" alt=""></div>
                    </div>
                @endif
                <br>
            </div>
            <form action="" id="myForm" onsubmit="return checkEver()">
                <div class="prices-box">
                    <h3>@lang('rooms.Prices') </h3>

                    @if (Session::get('locale') == "ar")
                        <div class="row price-notice">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <img src="{{ asset('assets/imgs/weekdays-pr-ar.png') }}" alt="">
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <img src="{{ asset('assets/imgs/weekend-pr-ar.png') }}" alt="">
                            </div>
                        </div>
                    @else
                        <div class="row price-notice">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <img src="{{ asset('assets/imgs/weekdays-pr.png') }}" alt="">
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <img src="{{ asset('assets/imgs/weekend-pr.png') }}" alt="">
                            </div>
                        </div>
                    @endif
                    <?php $counter = 0;
                    $avalibalSlots = \DHalper::getAvailableSlots($room->id);
                    ?>
                    @foreach($avalibalSlots[0]["prices"] as $rooming)
                        @if ($counter < 3)
                            @if ($counter == 0)
                                <div class="row">
                                    @endif
                                    <div class="col-xs-4">
                                        <img src="{{asset($rooming["icon"])}}" class="img-responsive" alt="">
                                        <span class="days-prices">{{$rooming["price"]}} @lang('rooms.srPlayer')</span>
                                        <span class="ends-prices">{{$rooming["weekendPrice"]}} @lang('rooms.srPlayer')</span>
                                    </div>
                                    @if ($counter == 2)
                                </div>
                            @endif
                        @else
                            @if ($counter == 3)
                                <div class="row">
                                    @endif
                                    <div class="col-xs-6">
                                        <img src="{{asset($rooming["icon"])}}" class="img-responsive" alt="">
                                        <span class="days-prices">{{$rooming["price"]}} @lang('rooms.srPlayer')</span>
                                        <span class="ends-prices">{{$rooming["weekendPrice"]}} @lang('rooms.srPlayer')</span>
                                    </div>
                                    @if ($counter == (count($avalibalSlots[0]["prices"]) - 1) )
                                </div>
                            @endif
                        @endif
                        <?php $counter++;?>
                    @endforeach

                </div>
                <div class="row booking">
                    <div class="col-xs-12">
                        <h4>@lang('rooms.Set your booking details below') :</h4>
                        <div class="form-group select-wrapper">
                            <select class="form-control form-control--shadow u-Rounded " onchange="selectPlayers(this)"
                                    required>
                                <option>@lang('rooms.Select Number of Players') </option>
                                @for ($i = 2 ; $i <= $room->capacity ; $i ++ )
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group select-wrapper">
                            <select class="form-control form-control--shadow u-Rounded" onchange="selectDate(this)"
                                    required>
                                <option>@lang('rooms.Select the Date') </option>
                                @foreach ($avalibalSlots as $date )
                                    <option value="{{ $date["date"]["value"] }}">{{ $date["date"]["localization_date"] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-xs-12">

                        @foreach ($avalibalSlots as $date )
                            <div id="{{ $date["date"]["value"] }}" class='hidemein' style="display : none;">
                                <h5>@lang('rooms.Select the time slot on')
                                    <strong>{{ $date["date"]["localization_date"] }} :</strong></h5>
                                <table class="table">


                                    <?php
                                    $counteer = 1;
                                    ?>
                                    @foreach ($date["times"] as $slots )

                                        @if ($counteer%4 == 1)
                                            <tr>
                                                @endif

                                                @if($slots['avalibal'] == false )
                                                    <td class="booked">
                                                        <span class="booking-time">{{ $slots['time'] }}</span>
                                                        <span class="booking-status"><img
                                                                    src="{{ asset('assets/imgs/booked.png') }}" alt=""></span>
                                                    </td>
                                                @else
                                                    <td data-slots="times" class="avas" data-time="{{$slots['time']}}"
                                                        id='{{$date["date"]["value"]}}|{{$slots['time']}}'
                                                        style='cursor: pointer; background-color:black ;'
                                                        onclick="selectTime(event);">
                                                        <span class="booking-time" data-slots="times"
                                                              data-time="{{$slots['time']}}"
                                                              id='{{$date["date"]["value"]}}|{{$slots['time']}}'
                                                              style='cursor: pointer; '
                                                              onclick="selectTime(event);">{{ $controller->timeToArabic($slots['time']) }}</span>
                                                        <span class="booking-status" data-slots="times"
                                                              data-time="{{$slots['time']}}"
                                                              id='{{$date["date"]["value"]}}|{{$slots['time']}}'
                                                              style='cursor: pointer; '
                                                              onclick="selectTime(event);"> @lang('rooms.Available') </span>
                                                    </td>
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
            <div id="others" class="row other-rooms">
                <h4>@lang('rooms.See Our Other Rooms') </h4>

                @foreach(\DHalper::getRandomRooms(2, $room->id) as $room )
                    <a href="/room/{{ $room->id }}">
                        <div class="col-md-6 col-sm-12 no-padding no-margin">
                            <img class="img-responsive" src="{{ asset($room->image) }}" alt="{{$room->name}}">
                        </div>
                    </a>
                @endforeach

            </div>
        </div>
    </section>
    <!--hello end-->


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
            if (numberOfPlayers == 0 || date == "") {
                alert("All Fildes Are Requried | جميع الحقول مطلوبة ");
                return;
            }
            var allSlots = document.getElementsByClassName('avas');

            Array.prototype.forEach.call(allSlots, function (el) {
                el.style.backgroundColor = "#000";
                console.log(el.tagName);
            });


            var target = e.target;
            document.getElementById(target.id).style.backgroundColor = "#90520a";
            document.getElementById("myForm").action = "/booking/" + "{{ $room->id }}/" + window.btoa(numberOfPlayers) + "/" + window.btoa(date) + "/" + window.btoa(e.target.dataset.time);
            isOk = true;
            //document.getElementById("myForm").submit();
            console.log(document.getElementById('reserverr').style.display);
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
