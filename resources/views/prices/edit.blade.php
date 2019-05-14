@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Prices
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                {!! Form::model($prices, ['route' => ['prices.update', $prices->id], 'method' => 'patch']) !!}


                {!! Form::hidden('room_id', $room_id, ['class' => 'form-control']) !!}

                <!-- Players Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('players', 'Players:') !!}
                        <select name="" id="" class="form-control" disabled>
                            <option value="{{$prices->players}}">{{$prices->players}}</option>
                        </select>
                    </div>

                    <!-- Price Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('price', 'Price:') !!}
                        {!! Form::number('price', null, ['class' => 'form-control']) !!}
                    </div>

                   {{-- <!-- Weekendprice Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('weekendPrice', 'Weekendprice:') !!}
                        {!! Form::number('weekendPrice', null, ['class' => 'form-control']) !!}
                    </div>--}}

                    <!-- Submit Field -->
                    <div class="form-group col-sm-12">
                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                        <a href="{!! route('prices.index') !!}" class="btn btn-default">Cancel</a>
                    </div>


                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection