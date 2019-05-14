@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Settings (Room: {{$settings->room_name}})
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($settings, ['route' => ['settings.update', $settings->id], 'method' => 'patch']) !!}

                        @include('settings.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection