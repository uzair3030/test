@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Blocked IPs</h1>
        {{--<h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px"
               href="{!! route('bookings.create') !!}">Add New</a>
        </h1>--}}
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <form action="/admin/blockedIPs" method="GET">
                            <div class="row">
                                <form action="{{route('blockedIPs')}}" method="GET">
                                    <div class="col-md-3 col-sm-12 form-group"
                                         title="Search by booking Number or Mobile . . .">
                                        <input type="text" value="{{$q}}" name="q" class="form-control"
                                               placeholder="Search by IP . . .">
                                    </div>
                                    <div class="col-md-3 col-sm-12 form-group">
                                        <button type="submit" class="btn btn-primary">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            {{--<div id="imaginary_container">
                                <div class="input-group stylish-input-group">
Search by booking Number or Mobile . . .
                                    <input name="q" type="text" class="form-control" placeholder="">
                                    <span class="input-group-addon">
                                    <button type="submit">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                </span>
                                </div>
                            </div>--}}
                        </form>
                    </div>
                </div>
                {{--@include('bookings.table')--}}
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="bookings-table">
                        <thead>
                        <tr>
                            <th>IP</th>
                            <th>Created At</th>
                            <th colspan="3">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($items as $item)
                            <tr>
                                <td>{!! $item->ip !!}</td>

                                <td>{!! $controller->convertTimeToString($item->created_at) !!}</td>
                                <td>
                                    {!! Form::open(['route' => ['blockedIPs.destroy', $item->id], 'method' => 'delete']) !!}
                                    <div class='btn-group'>
                                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                    </div>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="pagination">
                    {{$items->links()}}
                </div>
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/booking.css')}}">
@endsection

