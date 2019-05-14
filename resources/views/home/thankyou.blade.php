@extends('home.layout.app')

@section('content')



    <!--hello start-->
    <section>
        <div class="container book-main">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="thank-you">
                        <img src="assets/imgs/thank-you.png" width="175" alt="Thank You">
                         @if (Session::get('locale') == "ar")
                        <br>
                        <br>
                        <p>
                            شكرًا ، تم استلام طلب حجزك! <br><br>
                            <span>
                                {{--لقد أرسلنا تفاصيل و معلومات الحجز--}}<br>
{{--
                                عبر البريد الالكتروني <br>
--}}
                                و سيقوم موظف الاستقبال بالاتصال بك قريبًا.
                            </span>
                        </p>

                        @else
                        <br><br>
                        <p>
                            Thank you for your booking request! <br><br>
                            <span>
                               {{-- We have just sent you an e-mail <br>
                                with complete information. --}}<br>
                                Our receptionist will contact you soon.
                            </span>
                        </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--hello end-->


@endsection