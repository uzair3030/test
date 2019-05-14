<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover" id="rooms-table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Number</th>
            <th>Age</th>
            <th>Capacity</th>
            <th>Category</th>
            {{--
                    <th>Duration</th>
            --}}
            <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($rooms as $rooms)
            <tr>
                <td>{!! $rooms->name_en !!}</td>
                <td>{!! $rooms->number !!}</td>
                <td>{!! $rooms->age !!}</td>
                <td>{!! $rooms->capacity !!}</td>
                <td>{!! $rooms->category !!}</td>
                {{--
                            <td>{!! $rooms->duration !!}</td>
                --}}
                <td>{!! $rooms->status !!}</td>
                <td>
                    {!! Form::open(['route' => ['rooms.destroy', $rooms->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('rooms.show', [$rooms->id]) !!}" class='btn btn-default btn-xs'><i
                                    class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('rooms.edit', [$rooms->id]) !!}" class='btn btn-default btn-xs'><i
                                    class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>