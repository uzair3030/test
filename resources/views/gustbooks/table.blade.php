<div class="row">
    @foreach($gustbooks as $gustbook)
        <div class="col-sm-4">
            <a href="{!! route('gustbooks.show', [$gustbook->id]) !!}"><img src="{{asset('uploads/'.$gustbook->image)}}" alt="Image" class="img-responsive"></a>
{{--
            @if($gustbook->status == 1) Active @else Inactive @endif
--}}
            {!! Form::open(['route' => ['gustbooks.destroy', $gustbook->id], 'method' => 'delete', 'style' => 'text-align: center;']) !!}
            <div style="text-align: center; margin-top: 10px;margin-bottom: 10px">
                <div class='btn-group'>
                    <a href="{!! route('gustbooks.show', [$gustbook->id]) !!}" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('gustbooks.edit', [$gustbook->id]) !!}" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    @endforeach
</div>