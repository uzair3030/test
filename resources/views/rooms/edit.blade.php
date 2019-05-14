@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Rooms
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($rooms, ['route' => ['rooms.update', $rooms->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('rooms.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>

    <section class="content-header">
            <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('prices.create') !!}?room_id={{ $rooms->id }}">Add New</a>
        </h1>
        <h1>
            Prices
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">

   <table class="table table-responsive" id="prices-table">
    <thead>
        <tr>
        <th>Players</th>
        <th>Price</th>
{{--
        <th>Weekendprice</th>
--}}
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($prices as $prices)
        <tr>
            <td>{!! $prices->players !!}</td>
            <td>{!! $prices->price !!}</td>
{{--
            <td>{!! $prices->weekendPrice !!}</td>
--}}
            <td>
                {!! Form::open(['route' => ['prices.destroy', $prices->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {{-- <a href="{!! route('prices.show', [$prices->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a> --}}
                     <a href="{!! route('prices.edit', [$prices->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}

                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

           </div>
       </div>
   </div>
@endsection

