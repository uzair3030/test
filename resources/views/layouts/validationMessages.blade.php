{{--BEGIN VALIDATION  MESSAGES--}}
<div class="row-fluid" @if(App::getLocale() == 'ar') style="text-align: right" @else style="text-align: left" @endif>
    <!-- block -->
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong><span class="fa fa-check"></span> {{ $message }} </strong>
        </div>
    @endif
    @if ($message = Session::get('warning'))
        <div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong><span class="fa fa-warning"></span> {{ $message }} </strong>
        </div>
    @endif
    @if ($message = Session::get('danger'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong><span class="fa fa-remove"></span> {{ $message }} </strong>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissable">
            <a class="panel-close close" data-dismiss="alert">×</a>
            <strong>{{trans('rooms.attention')}}: </strong>
            <ul style="list-style: square">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
{{--END VALIDATION  MESSAGES--}}