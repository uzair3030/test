@extends('home.layout.app')

@section('content')



    <!--hello start-->
    <section>
        <div class="container">
            <div class="row gray rules">
                <div class="col-md-12 col-sm-12">
                    <br><br><br><br>
                    <h5>"Are you brave enough to check-in ?"</h5>
                    <p>
                        Here, <br>
                        we do not accommodate long stays, <br>
                        only intense ones.....<br>
                        <br>
                        You have only one goal:
                    </p>
                    <h5>ESCAPE!</h5>
                    <p>
                        You and your team must discover <br>
                        the elements in the room <br>
                        which helps you crack the codes,<br>
                        and solve the puzzles.<br>
                        The clock is ticking, <br>
                        you have 60 minutes to earn freedom<br>
                        and checkout -- alive !<br>
                         Good luck.<br><br>
                    </p>
                </div>
            </div>
            <div class="row howworks">
                <br>
                <h3><span>HOW IT WORKS</span></h3>
                <img src="assets/imgs/rules-1.png" alt="">
                <h4>Gather your team</h4>
                <img class="arrow" src="assets/imgs/rules-bottom-arrow.png" alt="">
                <img src="assets/imgs/rules-2.png" alt="">
                <h4>Book a room</h4>
                <img class="arrow" src="assets/imgs/rules-bottom-arrow.png" alt="">
                <img src="assets/imgs/rules-3.png" alt="">
                <h4>Arrive 30 minutes earlier</h4>
                <img class="arrow" src="assets/imgs/rules-bottom-arrow.png" alt="">
                <img src="assets/imgs/rules-4.png" alt="">
                <h4>Check in</h4>
            </div>
            <div class="row prohitbited">
                <br>
                <h3>PROHIBITED</h3>
                <br>
                <div class="col-sm-4 col-xs-4">
                    <img src="assets/imgs/pro-1.png" alt="">
                    <h4>Mobile</h4>
                </div>
                <div class="col-sm-4 col-xs-4">
                    <img src="assets/imgs/pro-2.png" alt="">
                    <h4>Food</h4>
                </div>
                <div class="col-sm-4 col-xs-4">
                    <img src="assets/imgs/pro-3.png" alt="">
                    <h4>Bag</h4>
                </div>
                <div class="col-sm-4 col-xs-4">
                    <img src="assets/imgs/pro-4.png" alt="">
                    <h4>Heels</h4>
                </div>
                <div class="col-sm-4 col-xs-4">
                    <img src="assets/imgs/pro-5.png" alt="">
                    <h4>Violence</h4>
                </div>
                <div class="col-sm-4 col-xs-4">
                    <img src="assets/imgs/pro-6.png" alt="">
                    <h4>Breaking</h4>
                </div>
                <br>
                <p class="rules-notice">* Lockers are available at location.</p>
                <p class="rules-notice">* All rooms are monitored by CCTV.</p>
            </div>
            <div class="row faq">
                <br>
                <h3>FAQ</h3>
                <br>
                <div class="panel-group u-PaddingRight20 u-sm-PaddingRight0" id="accordion1">
                    <div class="panel panel-default--">
                        <div class="panel-heading" id="heading1">
                            <div class="panel-title ">
                                <a role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                    What is an Escape Game?
                                </a>
                            </div>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading1">
                            <div class="panel-body">
                                It is a live action game where you must physically search the environment for items and clues that will help you escape the room. <br>
You are given a set amount of time to try and escape before your fate is sealed.
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default--">
                        <div class="panel-heading" role="tab" id="heading2">
                            <div class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                    How much is it to book a room?
                                </a>
                            </div>
                        </div>
                        <div id="collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2">
                            <div class="panel-body">
                                Well, that depends on the number of people in your group, check prices in rooms info pages.
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default--">
                        <div class="panel-heading" role="tab" id="heading3">
                            <div class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                    Will my group be paired with another group?
                                </a>
                            </div>
                        </div>
                        <div id="collapse3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading3">
                            <div class="panel-body">
                                No, never. We offer private bookings only.
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default--">
                        <div class="panel-heading" role="tab" id="heading4">
                            <div class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                    I’m a little claustrophobic, will I be okay?
                                </a>
                            </div>
                        </div>
                        <div id="collapse4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading4">
                            <div class="panel-body">
                                Our rooms are the same size as any regular room, and if you ever need any assistance, our game 
masters are watching at all times.
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default--">
                        <div class="panel-heading" role="tab" id="heading5">
                            <div class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                    Are there any actors in the room with us?
                                </a>
                            </div>
                        </div>
                        <div id="collapse5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading5">
                            <div class="panel-body">
                                Yes, there will be an-actor in one room for now.
 Any touching of the actors or disrespectful or 
malicious contact (verbal or physical) within the game will result in immediate disqualification.
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default--">
                        <div class="panel-heading" role="tab" id="heading6">
                            <div class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapse6" aria-expanded="false" aria-controls="collapse6">
                                    Who can play an escape game?
                                </a>
                            </div>
                        </div>
                        <div id="collapse6" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading6">
                            <div class="panel-body">
                                Anyone that’s looking for something fun and 
different to do! It’s suitable for teams of friends, family, colleagues, or anyone you want to share some valuable time with.
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default--">
                        <div class="panel-heading" role="tab" id="heading7">
                            <div class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapse7" aria-expanded="false" aria-controls="collapse7">
                                    Can I play by myself?
                                </a>
                            </div>
                        </div>
                        <div id="collapse7" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading7">
                            <div class="panel-body">
                                The minimum group size is 2 people. 
It is impossible to accomplish some of our puzzles with less than 2 people, and if you would like to play a game solo, you will be required to pay the price of 2 people.
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default--">
                        <div class="panel-heading" role="tab" id="heading8">
                            <div class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapse8" aria-expanded="false" aria-controls="collapse8">
                                    Is there any special knowledge required?
                                </a>
                            </div>
                        </div>
                        <div id="collapse8" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading8">
                            <div class="panel-body">
                                None! If you need to know anything special, 
we provide you with some hints to help you figure it out.
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default--">
                        <div class="panel-heading" role="tab" id="heading9">
                            <div class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapse9" aria-expanded="false" aria-controls="collapse9">
                                    I’m not sure how many people are going
to be in my group, what should I reserve?
                                </a>
                            </div>
                        </div>
                        <div id="collapse9" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading9">
                            <div class="panel-body">
                                If you are unsure, we suggest that you select 
“2 Players” when booking your timeslot – you can always add to your group and we will make the proper adjustments to your order when you arrive.
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default--">
                        <div class="panel-heading" role="tab" id="heading10">
                            <div class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapse10" aria-expanded="false" aria-controls="collapse10">
                                    I paid already, but have to cancel,
Do I get a refund?
                                </a>
                            </div>
                        </div>
                        <div id="collapse10" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading10">
                            <div class="panel-body">
                                We have a strict 
NO CANCELLATION / NO REFUND policy. 
All sales are final and nonrefundable regardless of reason. 
Please be aware of this before booking your 
reservation with us.
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default--">
                        <div class="panel-heading" role="tab" id="heading11">
                            <div class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapse11" aria-expanded="false" aria-controls="collapse11">
                                    I need to reschedule my reservation!
                                </a>
                            </div>
                        </div>
                        <div id="collapse11" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading11">
                            <div class="panel-body">
                                If you need to reschedule, you MUST contact us AT LEAST 2 days (48 hours) before your 
reservation time. If you contact us after this period, 
or if your booking was created within this period, we WILL NOT be able to reschedule your 
booking. Please be aware of this before booking your reservation with us.
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default--">
                        <div class="panel-heading" role="tab" id="heading12">
                            <div class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapse12" aria-expanded="false" aria-controls="collapse12">
                                    Are there any age restriction to attend?
                                </a>
                            </div>
                        </div>
                        <div id="collapse12" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading12">
                            <div class="panel-body">
                                Persons under the age of 12 years are prohibited 
to enter the Hotel. <br>
                           <strong><u>Rooms 7 and 13:</u></strong> Person between the age 12-15 must be accompanied inside by an adult (18 years). <br>
                            <strong><u>Room 19:</u></strong> Persons under the age of 18 are not allowed inside this room.
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default--">
                        <div class="panel-heading" role="tab" id="heading13">
                            <div class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapse13" aria-expanded="false" aria-controls="collapse13">
                                    How many people can play at once?
                                </a>
                            </div>
                        </div>
                        <div id="collapse13" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading13">
                            <div class="panel-body">
                                Each room varies, see below for maximum 
                                allowances: <br>
                                The Mummy = Up to 6 people, <br>
                                <a href="/room/2">Click here to reserve.</a><br>
                                Jumanji = Up to 8 people, <br>
                                <a href="/room/1">Click here to reserve.</a><br>
                                Pirates dungeon = Up to 10 people, <br>
                                <a href="/room/4">Click here to reserve.</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default--">
                        <div class="panel-heading" role="tab" id="heading14">
                            <div class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapse14" aria-expanded="false" aria-controls="collapse14">
                                    It would be fun to bring my colleagues here!
Any special offers for schools and companies?
                                </a>
                            </div>
                        </div>
                        <div id="collapse14" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading14">
                            <div class="panel-body">
                                Absolutely, <a href="tel:0501705577">give us a call.</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--hello end-->

@endsection