<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $settings->id !!}</p>
</div>

<!-- Startworktime Field -->
<div class="form-group">
    {!! Form::label('startWorkTime', 'Startworktime:') !!}
    <p>{!! $settings->startWorkTime !!}</p>
</div>

<!-- Endworktime Field -->
<div class="form-group">
    {!! Form::label('endWorkTime', 'Endworktime:') !!}
    <p>{!! $settings->endWorkTime !!}</p>
</div>

<!-- Weekenddays Field -->
<div class="form-group">
    {!! Form::label('weekendDays', 'Weekenddays:') !!}
    <p>{!! $settings->weekendDays !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $settings->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $settings->updated_at !!}</p>
</div>

