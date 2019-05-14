<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $bookings->id !!}</p>
</div>

<!-- Room Id Field -->
<div class="form-group">
    {!! Form::label('room_id', 'Room:') !!}
    <p>{!! $bookings->room->name !!}</p>
</div>

<!-- Startdatetime Field -->
<div class="form-group">
    {!! Form::label('startDateTime', 'Startdatetime:') !!}
    <p>{!! $bookings->startDateTime !!}</p>
</div>

<!-- Enddatetime Field -->
<div class="form-group">
    {!! Form::label('endDateTime', 'Enddatetime:') !!}
    <p>{!! $bookings->endDateTime !!}</p>
</div>

<!-- Customername Field -->
<div class="form-group">
    {!! Form::label('customerName', 'Customername:') !!}
    <p>{!! $bookings->customerName !!}</p>
</div>

{{--<!-- Customeremail Field -->
<div class="form-group">
    {!! Form::label('customerEmail', 'Customeremail:') !!}
    <p>{!! $bookings->customerEmail !!}</p>
</div>--}}

<!-- Players Field -->
<div class="form-group">
    {!! Form::label('players', 'Players:') !!}
    <p>{!! $bookings->players !!}</p>
</div>

<!-- Customermobile Field -->
<div class="form-group">
    {!! Form::label('customerMobile', 'Customermobile:') !!}
    <p>{!! $bookings->customerMobile !!}</p>
</div>

<!-- Grand Total Field -->
<div class="form-group">
    {!! Form::label('total', 'Grand Total (SAR):') !!}
    <p>{!! $bookings->total !!}</p>


</div>
<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{!! $bookings->status !!}</p>
</div>

<!-- deadlineForPaid Field -->
<div class="form-group">
    {!! Form::label('deadlineForPaid', 'Deadline For Paid:') !!}
    <p>{!! $bookings->deadlineForPaid !!}</p>
</div>

<!-- notes Field -->
<div class="form-group">
    {!! Form::label('notes', 'Notes:') !!}
    <p>{{ $bookings->notes != null ? $bookings->notes : "-" }}</p>
</div>
<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $bookings->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $bookings->updated_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('ip', 'IP') !!}
    <p> @if($bookings->ip != "") {{$bookings->ip}} @else Not provided @endif</p>
</div>

@if($bookings->ip != null)
    <form action="{{url('admin/blockIP')}}" method="POST">
        {{csrf_field()}}
        <input type="text" value="{{$bookings->ip}}" name="ip" style="display: none">
        <button type="submit" class="btn btn-danger">Add IP to blocked List</button>
    </form>
    <br>
@endif