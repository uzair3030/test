@extends('home.layout.app')

@section('content')


    <!--hello start-->
    <section>
        <div class="container">
            <div class="row guests">
                @if($gusts->count() == 0)
                    <div class="row gray">
                        <div class="row text-center">
                            <div class="col-xs-12">
                                <div class="room-spec">
                                    <span class="fa fa-image"></span>
                                    <span> @lang('rooms.not found guests')</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @foreach ($gusts as $gust )
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <img src="{{ asset('uploads/'.$gust->image ) }}" class="img-responsive" alt="Guest Name">
                    </div>
                @endforeach
                @if($gusts->count() > 23)
                    <div class="pagination">
                        {{$gusts->links()}}
                    </div>
                @endif

                {{-- <ul class="pagination">
                  <li><a href="#"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Previous</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">4</a></li>
                  <li><a href="#">...</a></li>
                  <li><a href="#">Next <i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
                </ul> --}}
            </div>

        </div>
    </section>
    <!--hello end-->

@endsection


@section('css')
    <link rel="stylesheet" href="{{asset('css/guests.css')}}">
@endsection