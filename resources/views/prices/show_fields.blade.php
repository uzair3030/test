<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $prices->id !!}</p>
</div>

<!-- Room Id Field -->
<div class="form-group">
    {!! Form::label('room_id', 'Room Id:') !!}
    <p>{!! $prices->room_id !!}</p>
</div>

<!-- Players Field -->
<div class="form-group">
    {!! Form::label('players', 'Players:') !!}
    <p>{!! $prices->players !!}</p>
</div>

<!-- Price Field -->
<div class="form-group">
    {!! Form::label('price', 'Price:') !!}
    <p>{!! $prices->price !!}</p>
</div>

<!-- Weekendprice Field -->
{{--<div class="form-group">
    {!! Form::label('weekendPrice', 'Weekendprice:') !!}
    <p>{!! $prices->weekendPrice !!}</p>
</div>--}}

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $prices->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $prices->updated_at !!}</p>
</div>

