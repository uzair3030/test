
<!-- Room Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('room_id', 'Room Id:') !!}
    {!! Form::select('room_id', $rooms, null, ['class' => 'form-control']) !!}
</div>

<!-- Customername Field -->
<div class="form-group col-sm-6">
    {!! Form::label('customerName', 'Customername:') !!}
    {!! Form::text('customerName', null, ['class' => 'form-control']) !!}
</div>

<!-- Customeremail Field -->
<div class="form-group col-sm-6">
    {!! Form::label('customerEmail', 'Customeremail:') !!}
    {!! Form::email('customerEmail', null, ['class' => 'form-control']) !!}
</div>

<!-- Players Field -->
<div class="form-group col-sm-6">
    {!! Form::label('players', 'Players:') !!}
    {!! Form::number('players', null, ['class' => 'form-control']) !!}
</div>

<!-- Customermobile Field -->
<div class="form-group col-sm-6">
    {!! Form::label('customerMobile', 'Customermobile:') !!}
    {!! Form::text('customerMobile', null, ['class' => 'form-control']) !!}
</div>

<!-- Customermobile Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    <select name="status" id="status" class="form-control">
        <option value="pending" {{($bookings->status == "pending") ? "selected" : ""}}>Pending</option>
        <option value="approved"  {{($bookings->status == "approved") ? "selected" : ""}}>Approved</option>
        <option value="canceled"  {{($bookings->status == "canceled") ? "selected" : ""}}>Canceled</option>
    </select>
</div>

<!-- Notes Field -->
<div class="form-group col-sm-12">
    {!! Form::label('notes', 'Notes:') !!}
    {!! Form::textarea('notes', $bookings->notes, ['class' => 'form-control']) !!}
</div>
{{--<div class="form-group col-sm-6">
    {!! Form::label('status', 'status :') !!}
    {!! Form::select('status', ["New"=>"New","in Hold"=>"in Hold","approved"=>"approved","cancaled"=>"cancaled"], ['class' => 'form-control']) !!}
</div>--}}

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('bookings.index') !!}" class="btn btn-default">Cancel</a>
</div>
