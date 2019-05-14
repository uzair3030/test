@extends('home.layout.app')

@section('content')


<!--hello start-->
    <section>
        <div class="container">
            <div class="row gray rules">
                <div class="col-md-12 col-sm-12">
                    <br><br><br><br>
<!--                    <h5>هل تملك الشــجاعة الكافية لتســجيل الدخول ؟!</h5>-->
                    <p><img src="assets/imgs/rules-p-1-ar.png" alt=""></p>
                    <p> 
                        هنا،<br>
                        لا نستضيف الإقامات الطويلة ،<br>
                        بل المثيرة .....<br><br>
                        لديك هدف واحد فقط :<br>
                    </p>
<!--                    <h5>الهروب !</h5>-->
                   <p><img src="assets/imgs/rules-p-2-ar.png" alt=""></p>
                    <p>
                        اكتشف العناصر الموجودة في الغرفة <br>
                        و التي ستساعدك على فك الرموز ،<br>
                        وحل الألغاز.<br>
                        الوقت هو خصمك الأول!<br>
                        لديك 60 دقيقة للنجاة. <br>
                        حظ موفق.<br><br>
                    </p>
                </div>
            </div>
            <div class="row howworks">
                <br>
                <h3><span>الخطوات</span></h3>
                <img src="assets/imgs/rules-1.png" alt="">
                <h4>اجمع فريقك</h4>
                <img class="arrow" src="assets/imgs/rules-bottom-arrow.png" alt="">
                <img src="assets/imgs/rules-2.png" alt="">
                <h4>احجز غرفة</h4>
                <img class="arrow" src="assets/imgs/rules-bottom-arrow.png" alt="">
                <img src="assets/imgs/rules-3.png" alt="">
                <h4>احضر قبل الموعد ب 30 دقيقة</h4>
                <img class="arrow" src="assets/imgs/rules-bottom-arrow.png" alt="">
                <img src="assets/imgs/rules-4.png" alt="">
                <h4>سجّل للدخول</h4>
            </div>
            <div class="row prohitbited">
                <br>
                <h3>المحذورات</h3>
                <br>
                <div class="col-sm-4 col-xs-4">
                    <img src="assets/imgs/pro-1.png" alt="">
                    <h4>جوال</h4>
                </div>
                <div class="col-sm-4 col-xs-4">
                    <img src="assets/imgs/pro-2.png" alt="">
                    <h4>طعام</h4>
                </div>
                <div class="col-sm-4 col-xs-4">
                    <img src="assets/imgs/pro-3.png" alt="">
                    <h4>حقيبة</h4>
                </div>
                <div class="col-sm-4 col-xs-4">
                    <img src="assets/imgs/pro-4.png" alt="">
                    <h4>كعب عالي</h4>
                </div>
                <div class="col-sm-4 col-xs-4">
                    <img src="assets/imgs/pro-5.png" alt="">
                    <h4>عنف</h4>
                </div>
                <div class="col-sm-4 col-xs-4">
                    <img src="assets/imgs/pro-6.png" alt="">
                    <h4>تكسير</h4>
                </div>
                <br>
                <p class="rules-notice">* يوجد لدينا خزائن لحفظ ممتلكاتكم الشخصية.</p>
                <p class="rules-notice">* جميع الغرف مراقبة بكاميرات.</p>
            </div>
            <div class="row faq">
                <br>
                <h3>الأسئلة المتكررة</h3>
                <br>
                <div class="panel-group u-PaddingRight20 u-sm-PaddingRight0" id="accordion1">
                    <div class="panel panel-default--">
                        <div class="panel-heading" id="heading1">
                            <div class="panel-title ">
                                <a role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                    ما هي فكرة مغامرة الهروب ؟
                                </a>
                            </div>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading1">
                            <div class="panel-body">
                                مغامرة واقعية ممتعة بمفهوم جديد للترفيه.
كل غرفة تمثل قصة معينة.  لديك 60 دقيقة لايجاد الحلول و فك الشفرات بالتعاون مع فريقك. <br>
واحدة من أفضل الطرق لخلق الذكريات الرائعة سواء مع مجموعة من الأصدقاء، أفراد العائلة أو حتى زملاء العمل!
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default--">
                        <div class="panel-heading" role="tab" id="heading2">
                            <div class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                    كم هي الأســعار ؟
                                </a>
                            </div>
                        </div>
                        <div id="collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2">
                            <div class="panel-body">
                                السعر يعتمد على عدد الأشخاص في مجموعتك ، 
كلما زاد العدد، قل السعر للشخص الواحد.
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default--">
                        <div class="panel-heading" role="tab" id="heading3">
                            <div class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                    هل سيتم ضم مجموعتي مع مجموعة أخرى؟
                                </a>
                            </div>
                        </div>
                        <div id="collapse3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading3">
                            <div class="panel-body">
                                لا أبدا. نحن نقدم الحجوزات الخاصة فقط.
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default--">
                        <div class="panel-heading" role="tab" id="heading4">
                            <div class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                    لدي فوبيا الاماكن المغلقة، هل سأكون بخير؟
                                </a>
                            </div>
                        </div>
                        <div id="collapse4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading4">
                            <div class="panel-body">
                                لا تقلق، غرفنا بنفس حجم أي غرفة عادية ، و إذا احتجت
لأي مساعدة ، فإن كل غرفة لها مراقب خاص لمتابعة التحركات.
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default--">
                        <div class="panel-heading" role="tab" id="heading5">
                            <div class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                    هل هناك أي ممثلين في الغرفة معنا؟
                                </a>
                            </div>
                        </div>
                        <div id="collapse5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading5">
                            <div class="panel-body">
                                نعم ،  هناك ممثل في احدى الغرف (الغرفة رقم 19)
  أي لمس للممثل أو عدم الاحترام اللفظي أو الجسدي داخل اللعبة سيؤدي إلى ايقاف المغامرة بالكامل في الحال.
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default--">
                        <div class="panel-heading" role="tab" id="heading6">
                            <div class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapse6" aria-expanded="false" aria-controls="collapse6">
                                    من يمكنه لعب لعبة هروب؟
                                </a>
                            </div>
                        </div>
                        <div id="collapse6" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading6">
                            <div class="panel-body">
                                أي شخص يبحث عن قضاء وقت ممتع و مختلف!
 مناسب لمجموعة من الأصدقاء أو العائلة أو زملاء العمل.
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default--">
                        <div class="panel-heading" role="tab" id="heading7">
                            <div class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapse7" aria-expanded="false" aria-controls="collapse7">
                                    هل استطيع المشــاركة بمفردي؟
                                </a>
                            </div>
                        </div>
                        <div id="collapse7" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading7">
                            <div class="panel-body">
                                الحد الأدنى للعدد في المجموعة هو شخصين على الأقل.
من الصعب انجاز بعض الألغاز بأقل من شخصين ،
 وإذا كنت ترغب في المشاركة بمفردك ، سيُطلب منك دفع ثمن شخصين.
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default--">
                        <div class="panel-heading" role="tab" id="heading8">
                            <div class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapse8" aria-expanded="false" aria-controls="collapse8">
                                    هل المغامرة تتطلب سابق معرفة معينة؟
                                </a>
                            </div>
                        </div>
                        <div id="collapse8" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading8">
                            <div class="panel-body">
                                لا أبداً!  إذا كنت بحاجة إلى معرفة شيء معين ،
فسنقدم لك بعض التلميحات داخل الغرفة لمساعدتك على اكتشاف الحلول.
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default--">
                        <div class="panel-heading" role="tab" id="heading9">
                            <div class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapse9" aria-expanded="false" aria-controls="collapse9">
                                    لست متأكدًا من عدد الأشخاص المشاركين 
في مجموعتي، ما العدد الذي يجب عليّ حجزه؟
                                </a>
                            </div>
                        </div>
                        <div id="collapse9" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading9">
                            <div class="panel-body">
                                إذا كنت غير متأكد، فإننا نقترح عليك اختيار 
"لاعبين اثنين" عند حجز موعدك.
 يمكنك دائمًا الإضافة إلى مجموعتك وسنقوم بإجراء التعديلات المناسبة على طلبك عند وصولك.
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default--">
                        <div class="panel-heading" role="tab" id="heading10">
                            <div class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapse10" aria-expanded="false" aria-controls="collapse10">
                                    لقد دفعت، ولكن يجب أن ألغي! هل يمكنني
استرداد المبلغ؟
                                </a>
                            </div>
                        </div>
                        <div id="collapse10" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading10">
                            <div class="panel-body">
                                نعتذر منكم، لدينا سياسة حاسمة للإلغاء و الاسترجاع.
جميع المبيعات نهائية وغير قابلة للإسترجاع.
بغض النظر عن السبب.
نأمل منكم مراعاة ذلك جيدًا قبل الحجز معنا.
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default--">
                        <div class="panel-heading" role="tab" id="heading11">
                            <div class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapse11" aria-expanded="false" aria-controls="collapse11">
                                    أحتاج إلى إعادة جدولة حجزي!
                                </a>
                            </div>
                        </div>
                        <div id="collapse11" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading11">
                            <div class="panel-body">
                                إذا كنت تريد إعادة الجدولة ، فيتوجب عليك الاتصال بنا
 قبل موعد حجزك  بــ يومين (48 ساعة).
 إذا اتصلت بنا بعد هذه الفترة ، أو إذا تم إنشاء حجزك خلال هذه الفترة ، فلن نتمكن من إعادة الجدولة.
نرجو أن تكون على علم بذلك قبل الحجز معنا.
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default--">
                        <div class="panel-heading" role="tab" id="heading12">
                            <div class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapse12" aria-expanded="false" aria-controls="collapse12">
                                    هل هناك قيود على العمر للدخول؟
                                </a>
                            </div>
                        </div>
                        <div id="collapse12" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading12">
                            <div class="panel-body">
                                لا يسمح بدخول الفندق من هم أقل من 12 سنة.<br>
                           <strong><u>الغرفة رقم 7 و 13 :</u></strong> من سن 12 الى 15 سنة يجب أن يرافقه شخص بالغ ( 18 عامًا ) بالداخل.<br>
                            <strong><u>الغرفة رقم 19 :  </u></strong>  لا يسمح لمن هم دون 18 سنة بالدخول.
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default--">
                        <div class="panel-heading" role="tab" id="heading13">
                            <div class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapse13" aria-expanded="false" aria-controls="collapse13">
                                    كم عدد الأشخاص الذين يمكنهم اللعب
في وقت واحد؟
                                </a>
                            </div>
                        </div>
                        <div id="collapse13" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading13">
                            <div class="panel-body">
                                 تختلف كل غرفة ، انظر أدناه للحصول على الحد الأقصى
لعدد الاشخاص في الغرفة الواحدة:<br>
المومياء =  الحد الأقصى  6 أشخاص ،<br>
<a href="/room/2">انقر هنا للحجز.</a><br>
جومانجي = الحد الأقصى 8 أشخاص ،،<br>
<a href="/room/1">انقر هنا للحجز.</a><br>
زنزانة القراصنة = الحد الأقصى  10 أشخاص ،<br>
<a href="/room/4">انقر هنا للحجز.</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default--">
                        <div class="panel-heading" role="tab" id="heading14">
                            <div class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapse14" aria-expanded="false" aria-controls="collapse14">
                                    سيكون ممتعًا احضار زملائي هنا !
هل هناك عروض خاصة للمدارس و الشركات؟
                                </a>
                            </div>
                        </div>
                        <div id="collapse14" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading14">
                            <div class="panel-body">
                                بالتأكيد ، <a href="tel:0501705577">اتصل بنا .</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--hello end-->

@endsection