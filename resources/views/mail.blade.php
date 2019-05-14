{{--
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="utf-8">

</head>
<body>
<b>@lang('rooms.dear'){{$customer_name}} </b>
<p>{{$msg}}</p>
<small>The Escape Hotel</small>
</body>
</html>--}}
@if (\Session::get('locale') == "ar")
    تم إرسال الحجز إلى Hotel Escape ، وسوف نخطرك عندما نؤكد حجزك. شكرا لك - Hotel Escape
@else
    Your Reservation have been sent to Hotel Escape, We will notify you when we confirm your reservation. Thank you - Hotel Escape
@endif