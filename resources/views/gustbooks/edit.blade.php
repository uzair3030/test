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
               <div class="row">
                   {!! Form::model($gustbook, ['route' => ['gustbooks.update', $gustbook->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('gustbooks.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection