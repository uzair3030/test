@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Gustbook
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <p class="alert alert-danger"><span class="fa fa-info-circle"></span> Hint: Image Dimensions must be: 285 x 285 pixels </p>
                <div class="row">
                    {!! Form::open(['route' => 'gustbooks.store', 'files' => true]) !!}

                        @include('gustbooks.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
