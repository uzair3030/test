@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Settings</h1>
        {{--<h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('settings.create') !!}">Add New</a>
        </h1>--}}
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @include('settings.table')
            </div>
        </div>
        <hr>
    </div>
    <section class="content-header">
        <h1 class="pull-left">System Setting</h1>
        {{--<h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('settings.create') !!}">Add New</a>
        </h1>--}}
    </section>
    <div class="content" style="min-height: auto!important;">
        <div class="clearfix"></div>

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <form action="{{url('admin/systemSettings/holiday')}}" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <b>Holiday</b>
                            </div>
                            <div class="col-md-4">
                                <select required name="content" id="" class="form-control">
                                    <option {{($controller->getSystemSetting("holiday") == "Saturday") ? "selected" : ""}} value="Saturday">
                                        Saturday
                                    </option>
                                    <option {{($controller->getSystemSetting("holiday") == "Sunday") ? "selected" : ""}} value="Sunday">
                                        Sunday
                                    </option>
                                    <option {{($controller->getSystemSetting("holiday") == "Monday") ? "selected" : ""}} value="Monday">
                                        Monday
                                    </option>
                                    <option {{($controller->getSystemSetting("holiday") == "Tuesday") ? "selected" : ""}} value="Tuesday">
                                        Tuesday
                                    </option>
                                    <option {{($controller->getSystemSetting("holiday") == "Wednesday") ? "selected" : ""}} value="Wednesday">
                                        Wednesday
                                    </option>
                                    <option {{($controller->getSystemSetting("holiday") == "Thursday") ? "selected" : ""}} value="Thursday">
                                        Thursday
                                    </option>
                                    <option {{($controller->getSystemSetting("holiday") == "Friday") ? "selected" : ""}} value="Friday">
                                        Friday
                                    </option>
                                    <option {{($controller->getSystemSetting("holiday") == "disabled") ? "selected" : ""}} value="disabled">
                                        -- disable
                                        holiday --
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Save
                                </button>

                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>
        <hr>
    </div>
    <div class="content" style="min-height: auto!important;">
        <div class="clearfix"></div>

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <form action="{{url('admin/systemSettings/theEarliestTimeToBook')}}" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <b>The Earliest Time To Book (Min.)</b>
                            </div>
                            <div class="col-md-4">
                                <input required type="number" class="form-control" name="content"
                                       value="{{$controller->getSystemSetting("theEarliestTimeToBook")}}">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Save
                                </button>

                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>
        <hr>
    </div>
    <div class="content" style="min-height: auto!important;">
        <div class="clearfix"></div>

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <form action="{{url('admin/systemSettings/adminNotificationEmail')}}" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <b>Admin Notification Email</b>
                            </div>
                            <div class="col-md-4">
                                <input required type="email" class="form-control" name="content"
                                       value="{{$controller->getSystemSetting("adminNotificationEmail")}}">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Save
                                </button>

                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>
        <hr>
    </div>
    <div class="content" style="min-height: auto!important;">
        <div class="clearfix"></div>

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <form action="{{url('admin/systemSettings/contactUs_email')}}" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <b>Contact Us Email</b>
                            </div>
                            <div class="col-md-4">
                                <input required type="email" class="form-control" name="content"
                                       value="{{$controller->getSystemSetting("contactUs_email")}}">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Save
                                </button>

                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>
        <hr>
    </div>
    <div class="content" style="min-height: auto!important;">
        <div class="clearfix"></div>

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <form action="{{url('admin/systemSettings/contactUs_phone')}}" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <b>Contact Us Phone</b>
                            </div>
                            <div class="col-md-4">
                                <input type="tel" class="form-control" placeholder="E.g: 05xxxxxxxx" name="content"
                                       required
                                       maxlength="10" pattern=".{10,10}" title="E.g: 05xxxxxxxx"
                                       value="{{$controller->getSystemSetting("contactUs_phone")}}">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Save
                                </button>

                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>
        <hr>
    </div>
    <div class="content" style="min-height: auto!important;">
        <div class="clearfix"></div>

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <form action="{{url('admin/systemSettings/contactUs_working_days_en')}}" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <b>English | Contact Us working days</b>
                            </div>
                            <div class="col-md-4">
                                <input required type="email" class="form-control" name="content"
                                       value="{{$controller->getSystemSetting("contactUs_working_days_en")}}">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Save
                                </button>

                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>
        <hr>
    </div>
    <div class="content" style="min-height: auto!important;">
        <div class="clearfix"></div>

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <form action="{{url('admin/systemSettings/contactUs_working_times_en')}}" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <b>English | Contact Us working times</b>
                            </div>
                            <div class="col-md-4">
                                <input type="text" required class="form-control" name="content"
                                       value="{{$controller->getSystemSetting("contactUs_working_times_en")}}">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Save
                                </button>

                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>
        <hr>
    </div>
    <div class="content" style="min-height: auto!important;">
        <div class="clearfix"></div>

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <form action="{{url('admin/systemSettings/contactUs_working_days_ar')}}" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <b>Arabic | Contact Us working days</b>
                            </div>
                            <div class="col-md-4">
                                <input required type="text" class="form-control" name="content"
                                       value="{{$controller->getSystemSetting("contactUs_working_days_ar")}}">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Save
                                </button>

                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>
        <hr>
    </div>
    <div class="content" style="min-height: auto!important;">
        <div class="clearfix"></div>

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <form action="{{url('admin/systemSettings/contactUs_working_times_ar')}}" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <b>Arabic | Contact Us working times</b>
                            </div>
                            <div class="col-md-4">
                                <input required type="text" required class="form-control" name="content"
                                       value="{{$controller->getSystemSetting("contactUs_working_times_ar")}}">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Save
                                </button>

                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>
        <hr>
    </div>
    <hr>
    <section class="content-header">
        <h1 class="pull-left"><span class="fa fa-image"></span> Videos Setting</h1>
        {{--<h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('settings.create') !!}">Add New</a>
        </h1>--}}
    </section>
    <div class="content" style="min-height: auto!important;">
        <div class="clearfix"></div>

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <form action="{{url('admin/systemSettings/home_video')}}" method="POST"
                      enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <h2><b>Home video</b></h2>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <video width="100%" height="100%" controls class="video-fit">
                                    <source src="{{asset('img/settings/'.$controller->getSystemSetting("home_video"))}}"
                                            type="video/mp4">
                                </video>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <input required type="file" accept="video/mp4" class="form-control" name="content">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Save
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <hr>
    </div>
    <hr>
    <section class="content-header">
        <h1 class="pull-left"><span class="fa fa-image"></span> Images Settings</h1>
        {{--<h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('settings.create') !!}">Add New</a>
        </h1>--}}
    </section>
    <div class="content" style="min-height: auto!important;">
        <div class="clearfix"></div>

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <form action="{{url('admin/systemSettings/contactUs_image')}}" method="POST"
                      enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <h2><b>Contact Us Image</b></h2>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <img src="{{asset('img/settings/'.$controller->getSystemSetting("contactUs_image"))}}"
                                     alt="" class="img-responsive">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <input required type="file" accept="image/*" class="form-control" name="content">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Save
                                </button>

                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <hr>
    </div>
    <div class="content" style="min-height: auto!important;">
        <div class="clearfix"></div>

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <form action="{{url('admin/systemSettings/homeSlider_1')}}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <h2><b>Home Slider 1</b></h2>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <img src="{{asset('img/settings/'.$controller->getSystemSetting("homeSlider_1"))}}"
                                     alt="" class="img-responsive">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <input required type="file" accept="image/*" class="form-control" name="content">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Save
                                </button>

                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <hr>
    </div>
    <div class="content" style="min-height: auto!important;">
        <div class="clearfix"></div>

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <form action="{{url('admin/systemSettings/homeSlider_2')}}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <h2><b>Home Slider 2</b></h2>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <img src="{{asset('img/settings/'.$controller->getSystemSetting("homeSlider_2"))}}"
                                     alt="" class="img-responsive">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <input required type="file" accept="image/*" class="form-control" name="content">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Save
                                </button>

                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <hr>
    </div>
    <div class="content" style="min-height: auto!important;">
        <div class="clearfix"></div>

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <form action="{{url('admin/systemSettings/homeSlider_3')}}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <h2><b>Home Slider 3</b></h2>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <img src="{{asset('img/settings/'.$controller->getSystemSetting("homeSlider_3"))}}"
                                     alt="" class="img-responsive">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <input required type="file" accept="image/*" class="form-control" name="content">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Save
                                </button>

                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <hr>
    </div>
    <div class="content" style="min-height: auto!important;">
        <div class="clearfix"></div>

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <form action="{{url('admin/systemSettings/homeSlider_4')}}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <h2><b>Home Slider 4</b></h2>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <img src="{{asset('img/settings/'.$controller->getSystemSetting("homeSlider_4"))}}"
                                     alt="" class="img-responsive">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <input required type="file" accept="image/*" class="form-control" name="content">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Save
                                </button>

                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <hr>
    </div>
    <div class="content" style="min-height: auto!important;">
        <div class="clearfix"></div>

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <form action="{{url('admin/systemSettings/homeSlider_5')}}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <h2><b>Home Slider 5</b></h2>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <img src="{{asset('img/settings/'.$controller->getSystemSetting("homeSlider_5"))}}"
                                     alt="" class="img-responsive">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <input required type="file" accept="image/*" class="form-control" name="content">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Save
                                </button>

                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <hr>
    </div>
    <div class="content" style="min-height: auto!important;">
        <div class="clearfix"></div>

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <form action="{{url('admin/systemSettings/homeSlider_6')}}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <h2><b>Home Slider 6</b></h2>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <img src="{{asset('img/settings/'.$controller->getSystemSetting("homeSlider_6"))}}"
                                     alt="" class="img-responsive">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <input required type="file" accept="image/*" class="form-control" name="content">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Save
                                </button>

                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <hr>
    </div>
@endsection

