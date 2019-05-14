@extends('home.layout.app')

@section('content')
    <!--hello start-->
    <section>
        <div class="container book-main">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="reserve-info">
                        <form action="/finalBooking" method="POST">
                            @include('layouts.validationMessages')
                            <h4>@lang('rooms.Reservation details'):</h4>

                            @csrf
                            <input type="hidden" name="room_id" value="{{$data["room"]["id"]}}">
                            <input type="hidden" name="date" value="{{$data["date"]}}">
                            <input type="hidden" name="time" value="{{$data["time"]}}">
                            <input type="hidden" name="pl" value="{{$data["pl"]}}">
                            <input type="hidden" name="deadlineForPaid" value="{{$data["deadlineForPaid"]}}">

                            @if (Session::get('locale') == "ar")
                                <img src="/{{$data["room"]["image"]}}" class="img-responsive"
                                     alt="{{$data["room"]["name"]}}">

                            @else
                                <img src="/{{$data["room"]["image_en"]}}" class="img-responsive"
                                     alt="{{$data["room"]["name"]}}">
                            @endif

                            <div class="confirm-details">
                                <p>@lang('rooms.Date'): <span>{{$controller->translateDate($data["date"])}}</span></p>
                                <p>@lang('rooms.Time'): <span>{{ $controller->translateTime($data["time"]) }}</span></p>
                                <p>@lang('rooms.Number of players'): <span>{{$data["pl"]}}</span></p>
                            </div>
                            <br>
                            <div class="book-form">
                                <h4>@lang('rooms.Enter contact details'):</h4>
                                <div class="form-group">
                                    <label for="">@lang('rooms.Name')*</label>
                                    <input type="text" class="form-control" placeholder="" name="name" required>
                                </div>
                                {{-- <div class="form-group">
                                     <label for="">@lang('rooms.Email')*</label>
                                     <input type="email" class="form-control english-email" placeholder="" name="email"
                                            required>
                                 </div>--}}
                                <div class="form-group">
                                    <label for="">@lang('rooms.Phone')*</label>
                                    <input type="tel" class="form-control english-phone" placeholder="" name="phone"
                                           required
                                           maxlength="10" pattern=".{10,10}" title="E.g: 05xxxxxxxx">
                                </div>
                            </div>
                            <h4>@lang('rooms.Price'):</h4>
                            <p>@lang('rooms.Total price'):
                                <span>{{ $data["total"] * $data["pl"]  }} @lang('rooms.SAR') </span></p>
                            <h4>@lang('rooms.Choose payment option'):</h4>
                            {{-- <div class="form-group">
                                <label for="">
                                   @lang('rooms.MADA')
                                    <img src="/assets/imgs/mada.png" alt="">
                                    <input type="radio" checked="checked">
                                    <span class="checkmark"></span>
                                </label>
                            </div> --}}
                            <div class="form-group">
                                <label for="">@lang('rooms.Cash')
                                    <input type="radio" checked="checked">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <span class="hotel-dir"><a href="https://goo.gl/maps/9uVKh4jpAQw" target="_blank"><i
                                            class="fa fa-location-arrow" aria-hidden="true"></i> @lang('rooms.mapLink') </a></span>
                           {{-- <span class="pay-notice">
                               @lang('rooms.Note')        
                            </span>--}}

                            {{--final payment appointment--}}
                            @if (Session::get('locale') == "ar")
                                {{--<span class="time-notice">قبل {{$controller->translateDateTime($controller->convertTimeToString($data["deadlineForPaid"]))}}
                                    ({{$controller->translateDay($data["deadlineForPaidDay"])}})</span>--}}
                                <br>
                                <input class="sumit" type="image" src="{{ asset('assets/imgs/submit-ar.png') }}">
                            @else
                                {{--<span class="time-notice">Before {{$controller->translateDateTime($controller->convertTimeToString($data["deadlineForPaid"]))}}
                                    ({{$controller->translateDay($data["deadlineForPaidDay"])}})</span>--}}
                                <br>
                                <input class="sumit" type="image" src="{{ asset('assets/imgs/submit.png') }}">
                            @endif

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--hello end-->


@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/booking.css') }} ">
@endsection