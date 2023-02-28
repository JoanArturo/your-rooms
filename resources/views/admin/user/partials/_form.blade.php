<div class="form-row">
    <div class="col-12 col-md-6">
        <div class="form-group float-input">
            {!! Form::text('name', null, ['id' => 'name-input', 'class' => 'form-control', 'required' => true, 'autofocus' => true]) !!}
            {!! Form::label('name-input', __('validation.attributes.name')) !!}
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="form-group float-input">
            {!! Form::text('email', null, ['id' => 'email-input', 'class' => 'form-control', 'required' => true]) !!}
            {!! Form::label('email-input', __('validation.attributes.email')) !!}
        </div>
    </div>
</div>

@empty($user)
<div class="form-row">
    <div class="col-12 col-md-6">
        <div class="form-group float-input">
            {!! Form::password('password', ['id' => 'password-input', 'class' => 'form-control', 'required' => true]) !!}
            {!! Form::label('password-input', __('Password')) !!}
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="form-group float-input">
            {!! Form::password('password_confirmation', ['id' => 'password-confirm-input', 'class' => 'form-control', 'required' => true]) !!}
            {!! Form::label('password-confirm-input', __('Confirm Password')) !!}
        </div>
    </div>
</div>
@endempty

<div class="form-group float-input">
    {!! Form::select('role', $roles, null, ['id' => 'role-input', 'class' => 'select2-single']) !!}
    {!! Form::label('role-input', __('validation.attributes.role')) !!}
</div>

<div class="form-group float-input">
    {!! Form::select('account_status', $accountStatus, null, ['id' => 'account-status-input', 'class' => 'select2-single']) !!}
    {!! Form::label('account-status-input', __('validation.attributes.account_status')) !!}
</div>

<div class="d-flex align-items-center">
    <a class="btn btn-gray mr-2" type="submit" href="{{ route('admin.user.index') }}">{{ __('Back to list') }}</a>
    <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>
</div>