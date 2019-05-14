<div class="form-group col-sm-6">
    {!! Form::label('startWorkTime', 'Start work time:') !!}
    {!! Form::text('startWorkTime', null, ['class' => 'form-control', 'placeholder' => 'Example:  08:00']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('endWorkTime', 'End work time:') !!}
    {!! Form::text('endWorkTime', null, ['class' => 'form-control', 'placeholder' => 'Example:  22:00']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('durationOfRoomReservation', 'Duration (Min.):') !!}
    {!! Form::text('durationOfRoomReservation', null, ['class' => 'form-control', 'placeholder' => 'Example:  60']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('breakTimeBetweenEachBooking', 'Break Time (Min.):') !!}
    {!! Form::text('breakTimeBetweenEachBooking', null, ['class' => 'form-control', 'placeholder' => 'Example:  15']) !!}
</div>



<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('settings.index') !!}" class="btn btn-default">Cancel</a>
</div>