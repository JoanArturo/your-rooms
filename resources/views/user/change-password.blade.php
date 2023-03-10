@extends('layouts.app')

@section('page', __('Change password'))

@section('content')
<div class="top-separate">
    <h1 class="text-title text-center m-0 pb-4 mb-2">{{ __('Change password') }}</h1>
    <div class="container-sm container-center">
        {!! Form::open(['url' => route('user.updatePassword'), 'method' => 'put']) !!}
            <div class="form-group float-input">
                {!! Form::password('new_password', ['id' => 'new-password-input', 'class' => 'form-control', 'required' => true]) !!}
                {!! Form::label('new-password-input', __('validation.attributes.new_password')) !!}
            </div>
            <div class="form-group float-input">
                {!! Form::password('new_password_confirmation', ['id' => 'new-password-confirmation-input', 'class' => 'form-control', 'required' => true]) !!}
                {!! Form::label('new-password-confirmation-input', __('validation.attributes.repeat_password')) !!}
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <button class="btn btn-block btn-primary" type="submit">{{ __('Save') }}</button>
                <a class="btn btn-block btn-gray m-0 ml-2" href="{{ route('user.profile') }}">{{ __('Cancel') }}</a>
            </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection
