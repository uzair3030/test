<!DOCTYPE html>
<html class="html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/imgs/favicon.png"/>

    <title>@lang('rooms.Title') |Escape Room in Jeddah </title>

    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Heebo:100%7COpen+Sans:300,400,400i,600,700,800">
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootsnav/css/bootsnav.css') }} ">
    <link rel="stylesheet" href="{{ asset('assets/vendor/font-awesome/css/font-awesome.min.css') }} ">


    <link rel="stylesheet" href="{{ asset('assets/vendor/alien-icon/css/style.css') }} ">

    <link rel="stylesheet" href="{{ asset('assets/vendor/owl.carousel2/owl.carousel.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('assets/vendor/magnific-popup/magnific-popup.css') }} ">
    <link rel="stylesheet" href="{{ asset('assets/vendor/switchery/switchery.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('assets/vendor/animate.css/animate.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/css/swiper.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('assets/css/alien.css') }} ">
    @if (Session::get('locale') == "ar")
        <link rel="stylesheet" href="{{ asset('assets/css/style-rtl.css') }} ">
@endif

@yield('css')
@include('layouts.favicon')


<!-- endinject -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-106548823-6"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-106548823-6');
    </script>

</head>
<body>
<!--header start-->
<header>
    <!-- Start Navigation -->
    <nav class="navbar navbar-default navbar-fixed navbar-transparent dark bootsnav">

        <div class="container">

            <!-- Start Header Navigation -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                    <img src="/assets/imgs/bars.png" class="faxbars" width="30" alt="">
                    <img src="/assets/imgs/times.png" class="faxtimes" style="display: none;" width="30" alt="">
                </button>
                <a class="navbar-brand" href="/">
                    <img src="/assets/imgs/logo.png" class="logo logo-display" alt="">
                    <img src="/assets/imgs/logo.png" class="logo logo-scrolled" alt="">
                </a>
            </div>
            <!-- End Header Navigation -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav navbar-right" data-in="" data-out="">
                    <li><a href="/">@lang('rooms.Home')</a></li>
                    <li><a href="/rooms">@lang('rooms.Rooms')</a></li>
                    <li><a href="/reserve">@lang('rooms.Reservations')</a></li>
                    <li><a href="/guests">@lang('rooms.Our Guests')</a></li>
                    <li><a href="/rules">@lang('rooms.Rules')</a></li>
                    <li><a href="/contact">@lang('rooms.LocationContact')</a></li>
                    <li>
                        <a href="/lang/@lang('rooms.NextlangCode')" @if(App::getLocale() == 'en') class="arabic_text"
                           @else class="english_text" @endif>@lang('rooms.Language')</a>
                    </li>
                </ul>
                <div class="social-links sl-default border-link circle-link colored-hover hidden-md hidden-lg">
                    <a href="https://www.instagram.com/theescapehotel/" target="_blank" class="instagram">
                        <img src="{{ asset('assets/imgs/inst-icon.png') }}" width="21" alt="">
                    </a>
                    <a href="https://www.snapchat.com/add/the.escapehotel" target="_blank" class="snapchat">
                        <img src="{{ asset('assets/imgs/snap-icon.png') }} " width="23" alt="">
                    </a>
                    <a href="https://twitter.com/theescapehotel" target="_blank" class="twitter">
                        <img src="{{ asset('assets/imgs/twitter-icon.png') }} " width="23" alt="">
                    </a>
                </div>
            </div><!-- /.navbar-collapse -->
        </div>
        <div class="navbar-header-border"></div>
    </nav>
    <!-- End Navigation -->
    <div class="clearfix"></div>
</header>
<!--header end-->
@yield('content')




<!--footer start-->
<footer>

    <section class="bg-darker u-PaddingTop10">
        <div class="container">
            <div class="row text-sm u-MarginTop20--">
                <div class="col-md-6 text-left text-center--sm">
                    @if (\Session::get('locale') == "ar")
                        <p class="u-LineHeight2"> جميع الحقوق محفوظة © {{Carbon\Carbon::now()->year}} فندق اسكيب | تطوير
                            و برمجة <a
                                    target="_blank" href="http://www.attarse.com/">عطار لهندسة البرامج</a></p>
                    @else
                        <p class="u-LineHeight2">Copyright © {{Carbon\Carbon::now()->year}} The Escape Hotel. All Rights
                            Reserved | Developed by <a
                                    target="_blank" href="http://www.attarse.com/">Attar SE</a></p>
                    @endif
                </div>
                <div class="col-md-6 text-right text-center--sm hidden-xs">
                    <ul class="list-inline text-paragraph u-LineHeight2 u-MarginBottom0">
                        <li><a href="/rules">@lang('rooms.Rules')</a></li>
                        <li>-</li>
                        <li><a href="/contact">@lang('rooms.LocationContact')</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

</footer>
<!--footer end-->


<!-- inject:js -->
<script src="{{ asset('assets/vendor/jquery/jquery-1.12.0.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootsnav/js/bootsnav.js') }}"></script>
<script src="{{ asset('assets/vendor/waypoints/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery.countTo/jquery.countTo.min.js') }}"></script>
<script src="{{ asset('assets/vendor/owl.carousel2/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery.appear/jquery.appear.js') }}"></script>
<script src="{{ asset('assets/vendor/isotope/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.js') }}"></script>
<script src="{{ asset('assets/vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/vendor/switchery/switchery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/swiper/js/swiper.min.js') }}"></script>
<script src="{{ asset('assets/js/alien.js') }}"></script>
<script>
    $(function () {
        $('.smoothScroll').click(function () {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000); // The number here represents the speed of the scroll in milliseconds
                    return false;
                }
            }
        });
    });
</script>

@yield('scripts')
<!-- endinject -->
</body>
</html>
