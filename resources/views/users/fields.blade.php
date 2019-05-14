<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<!-- Password Confirmation Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password_confirmation', 'Password Confirmation:') !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
</div>

<!-- Role -->
<div class="form-group col-sm-12">
    {!! Form::label('role', 'Role:') !!}
    @if(isset($user))
        <select name="role" class="form-control">
            <option {{($user->role == "admin") ? "selected" : ""}} value="admin">Admin</option>
            <option  {{($user->role == "manager") ? "selected" : ""}} value="manager">Booking Manager</option>
        </select>
    @else
        <select name="role" class="form-control">
            <option value="admin">Admin</option>
            <option value="manager">Booking Manager</option>
        </select>
    @endif
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-default">Cancel</a>
</div>


