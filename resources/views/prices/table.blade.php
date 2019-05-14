<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover" id="prices-table">
        <thead>
        <tr>
            <th>Room Id</th>
            <th>Players</th>
            <th>Price</th>
            <th>Weekendprice</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($prices as $prices)
            <tr>
                <td>{!! $prices->room_id !!}</td>
                <td>{!! $prices->players !!}</td>
                <td>{!! $prices->price !!}</td>
                <td>{!! $prices->weekendPrice !!}</td>
                <td>
                    {!! Form::open(['route' => ['prices.destroy', $prices->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('prices.show', [$prices->id]) !!}" class='btn btn-default btn-xs'><i
                                    class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('prices.edit', [$prices->id]) !!}" class='btn btn-default btn-xs'><i
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