@extends('home.layout.app')

@section('content')



    <!--hello start-->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 direction" id="direction">
                    <iframe st id="map"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3708.5977931819143!2d39.13051821494302!3d21.64059108567018!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15c3d93cb181bcc5%3A0x13a83174d37bad3e!2sThe+Escape+Hotel!5e0!3m2!1sen!2ssa!4v1535396700720"
                            width="100%" height="350" frameborder="0" allowfullscreen></iframe>
                    <button type="button" id="redirectToMap"
                            onclick="redirectToMap('https://www.google.com/maps/dir//21.6405911,39.1327069/@21.640591,39.132707,16z?hl=en-US')">
                        Google Map
                    </button>
                </div>
                <div class="col-md-12 col-sm-12 contact">
                    <img src="{{asset('img/settings/'.$controller->getSystemSetting("contactUs_image"))}}"
                         class="img-responsive" alt="Contact Escape Hotel ">
                    <div class="contact-info">
                        <p>email
                            <a href="mailto:{{$controller->getSystemSetting("contactUs_email")}}">{{$controller->getSystemSetting("contactUs_email")}}</a>
                        </p>
                        <p>call <a href="tel:{{$controller->getSystemSetting("contactUs_phone")}}"
                                   style="font-family: 'monbaiti', Roboto, Oxygen, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif !important;">{{$controller->getSystemSetting("contactUs_phone")}}</a>
                        </p>
                        <div class="social-links sl-default circle-link colored-hover">
                            <a href="https://www.instagram.com/theescapehotel/" target="_blank" class="instagram">
                                <img src="http://theescapehotel.net/assets/imgs/inst-icon.png" width="21" alt="">
                            </a>
                            <a href="https://www.snapchat.com/add/the.escapehotel" target="_blank" class="snapchat">
                                <img src="http://theescapehotel.net/assets/imgs/snap-icon.png " width="23" alt="">
                            </a>
                            <a href="https://twitter.com/theescapehotel" target="_blank" class="twitter">
                                <img src="http://theescapehotel.net/assets/imgs/twitter-icon.png " width="23" alt="">
                            </a>
                        </div>
                        <br>
                        <div class="eng-times">
                            <h4>Hours of operation</h4>
                            <p style="direction: ltr;">{{$controller->getSystemSetting("contactUs_working_days_en")}}
                                <br> <span
                                        style="direction: ltr;font-family: 'monbaiti', Roboto, Oxygen, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif !important;">{{$controller->getSystemSetting("contactUs_working_times_en")}}</span>
                            </p>
                            @if($controller->getSystemSetting("holiday") != "disabled")
                                <p>{{$controller->getSystemSetting("holiday")}}s: <span>Closed</span></p>
                            @endif
                            <br>
                        </div>
                        <div class="ara-times">
                            <h4>ساعات العمل</h4>
                            <p>{{$controller->getSystemSetting("contactUs_working_days_ar")}}<br>
                                <span>{{$controller->getSystemSetting("contactUs_working_times_ar")}} </span></p>
                            @if($controller->getSystemSetting("holiday") != "disabled")
                                <p><span>{{$controller->arabicDay($controller->getSystemSetting("holiday"))}}: </span>مغلق
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--hello end-->


@endsection

@section('scripts')
    <script>
        function redirectToMap(url) {
            window.location.replace(url);
        }
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/contactUs.css') }} ">
@endsection