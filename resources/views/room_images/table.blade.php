<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover" id="roomImages-table">
        <thead>
        <tr>
            <th>Room Id</th>
            <th>Img</th>
            <th>Title</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($roomImages as $roomImages)
            <tr>
                <td>{!! $roomImages->room_id !!}</td>
                <td>{!! $roomImages->img !!}</td>
                <td>{!! $roomImages->title !!}</td>
                <td>
                    {!! Form::open(['route' => ['roomImages.destroy', $roomImages->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('roomImages.show', [$roomImages->id]) !!}" class='btn btn-default btn-xs'><i
                                    class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('roomImages.edit', [$roomImages->id]) !!}" class='btn btn-default btn-xs'><i
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