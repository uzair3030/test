{{-- <!-- Room Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('room_id', 'Room Id:') !!}
    {!! Form::select('room_id', ['1' => 'room1', 'room2' => 'room2', '2' => '2'], null, ['class' => 'form-control']) !!}
</div> --}}


    {!! Form::hidden('room_id', $room_id, ['class' => 'form-control']) !!}

<!-- Players Field -->
<div class="form-group col-sm-6">
    {!! Form::label('players', 'Players:') !!}
        {!! Form::select('players', [
            '2' => '2',
            '3' => '3',
            '4' => '4',
            '5' => '5',
            '6' => '6',
            '7' => '7',
            '8' => '8',
            '9' => '9',
            '10' => '10'
            ], null, ['class' => 'form-control']) !!}

</div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', 'Price:') !!}
    {!! Form::number('price', null, ['class' => 'form-control']) !!}
</div>

<!-- Weekendprice Field -->
<div class="form-group col-sm-6">
    {!! Form::label('weekendPrice', 'Weekendprice:') !!}
    {!! Form::number('weekendPrice', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('prices.index') !!}" class="btn btn-default">Cancel</a>
</div>
