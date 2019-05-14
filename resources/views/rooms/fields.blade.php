<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name English:') !!}
    {!! Form::text('name_en', null, ['class' => 'form-control']) !!}
</div>

<!-- Desc Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('desc', 'Desc:') !!}
    {!! Form::textarea('desc', null, ['class' => 'form-control']) !!}
</div>

<!-- Desc Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('desc_en', 'Desc English:') !!}
    {!! Form::textarea('desc_en', null, ['class' => 'form-control']) !!}
</div>



<!-- Age Field -->
<div class="form-group col-sm-6">
    {!! Form::label('age', 'Age:') !!}
    {!! Form::text('age', null, ['class' => 'form-control']) !!}
</div>

<!-- Age Field -->
<div class="form-group col-sm-6">
    {!! Form::label('age', 'Age English:') !!}
    {!! Form::text('age_en', null, ['class' => 'form-control']) !!}
</div>


<!-- Capacity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('capacity', 'Capacity:') !!}
    {!! Form::number('capacity', null, ['class' => 'form-control']) !!}
</div>


    {!! Form::hidden('capacity_en', "", ['class' => 'form-control']) !!}

{{--<!-- Duration Field -->
<div class="form-group col-sm-6">
    {!! Form::label('duration', 'Duration:') !!}
    {!! Form::number('duration', null, ['class' => 'form-control']) !!}
</div>--}}


   {{-- {!! Form::hidden('duration_en', "", ['class' => 'form-control']) !!}--}}

<!-- Category Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category', 'Category:') !!}
    {!! Form::text('category', null, ['class' => 'form-control']) !!}
</div>


<!-- Category Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category', 'Category English:') !!}
    {!! Form::text('category_en', null, ['class' => 'form-control']) !!}
</div>


<!-- Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('number', 'Number:') !!}
    {!! Form::text('number', null, ['class' => 'form-control']) !!}
</div>

<!-- Video Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('videoUrl', 'videoUrl:') !!}
    {!! Form::text('videoUrl', null, ['class' => 'form-control']) !!}
</div>



<div class="form-group col-sm-12">


<div class="form-group col-sm-3">

@if(isset($rooms->image) && !empty($rooms->image) ) 
 <a href="{{ asset($rooms->image) }}" target="_blank"><img src="{{ asset($rooms->image) }}" width="50"></a>
@endif
    {!! Form::label('image', 'Room Main image Arabic :') !!}
    {!! Form::file('image', null, ['class' => 'form-control']) !!}


    @if(isset($rooms->image_en) && !empty($rooms->image_en) ) 
 <a href="{{ asset($rooms->image_en) }}" target="_blank"><img src="{{ asset($rooms->image_en) }}" width="50"></a>
@endif
    {!! Form::label('image', 'Room Main image English :') !!}
    {!! Form::file('image_en', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-3">
@if(isset($rooms->image1) && !empty($rooms->image1) ) 
 <a href="{{ asset('uploads/'.$rooms->image1) }}" target="_blank"><img src="{{ asset('uploads/'.$rooms->image1) }}" width="50"></a>
@endif


    {!! Form::label('image', 'image #1 :') !!}
    {!! Form::file('image1', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-3">
@if(isset($rooms->image2) && !empty($rooms->image2) ) 
 <a href="{{ asset('uploads/'.$rooms->image2) }}" target="_blank"><img src="{{ asset('uploads/'.$rooms->image2) }}" width="50"></a>
@endif

    {!! Form::label('image', 'image #2 :') !!}
    {!! Form::file('image2', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-3">
@if(isset($rooms->image3) && !empty($rooms->image3) ) 
 <a href="{{ asset('uploads/'.$rooms->image3) }}" target="_blank"><img src="{{ asset('uploads/'.$rooms->image3) }}" width="50"></a>
@endif

    {!! Form::label('image', 'image #3 :') !!}
    {!! Form::file('image3', null, ['class' => 'form-control']) !!}
</div>


</div>

<!-- Status Field -->
<div class="form-group col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    <select name="status" id="status" class="form-control">
        <option value="active" {{($rooms->status == "active") ? "selected" : ""}}>active</option>
        <option value="inactive"  {{($rooms->status == "inactive") ? "selected" : ""}}>inactive</option>
        <option value="pending"  {{($rooms->status == "pending") ? "selected" : ""}}>pending</option>
    </select>
{{--
    {!! Form::select('status', ["active" => "active","inactive" => "inactive","pending"=>"pending"], ['class' => 'form-control']) !!}
--}}
</div>
<!-- Status Field -->
<div class="form-group col-sm-12">
    {!! Form::label('status', 'Live performance room :') !!}
    {!! Form::checkbox('live_performance_room') !!}
</div>



<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('rooms.index') !!}" class="btn btn-default">Cancel</a>
</div>


