<form action="{{url('admin/deleteBookings')}}" method="get">
    <div class="table-responsive">
        <table class="table" id="bookings-table">
            <thead>
            <tr>
                <th></th>
                <th>Booking Number</th>
                <th>Room</th>
                {{--<th>Startdatetime</th>
                <th>Enddatetime</th>--}}
                <th>Customer Name</th>
                {{--
                        <th>Customer Email</th>
                --}}
                <th>Players</th>
                <th>Customer Mobile</th>
                <th>Grand Total
                    <small>SAR</small>
                </th>
                <th>Status</th>
                <th>Slot Time</th>
{{--
                <th>End Date Time</th>
--}}
                <th>Deadline For Paid</th>
                <th>Notes</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>

            @foreach($bookings as $booking)
                <tr>
                    <td><input name="booking[]" type="checkbox" value="{{$booking->id}}"></td>
                    <td>{!! $booking->id !!}</td>
                    <td>{!! $booking->room->name_en !!}</td>
                    {{--<td>{!! $booking->startDateTime !!}</td>
                    <td>{!! $booking->endDateTime !!}</td>--}}
                    <td>{!! $booking->customerName !!}</td>
                    {{--
                                <td>{!! $booking->customerEmail !!}</td>
                    --}}
                    <td>{!! $booking->players !!}</td>
                    <td>{!! $booking->customerMobile !!}</td>
                    <td>{!! $booking->total !!}</td>
                    <td>
                        @if($booking->status == "approved")
                            <span class="label label-success">{{$booking->status}}</span>
                        @elseif($booking->status == "pending")
                            <span class="label label-default">{{$booking->status}}</span>
                        @else
                            <span class="label label-danger">{{$booking->status}}</span>
                        @endif
                    </td>
                    <td>{!! $controller->convertTimeToString($booking->startDateTime) !!}</td>
                    {{--<td>{!! $controller->convertTimeToString($booking->endDateTime) !!}</td>--}}
                    <td>{!! $controller->convertTimeToString($booking->deadlineForPaid) !!}</td>
                    <td>{{$booking->notes != null ? $booking->notes : "-"}}</td>

                    <td>
                        {!! Form::open(['route' => ['bookings.destroy', $booking->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{!! route('bookings.show', [$booking->id]) !!}" class='btn btn-default btn-xs'><i
                                        class="glyphicon glyphicon-eye-open"></i></a>
                            <a href="{!! route('bookings.edit', [$booking->id]) !!}" class='btn btn-default btn-xs'><i
                                        class="glyphicon glyphicon-edit"></i></a>
                            {{--
                                                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                            --}}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button onclick="return confirm('Are you sure to delete the selected items?')" type="submit"
                    class="btn btn-danger"><span class="fa fa-remove"></span> Delete Selected Bookings
            </button>
        </div>
    </div>
</form>