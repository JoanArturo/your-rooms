@extends('layouts.app')

@section('page', __('Profile information'))

@section('content')
<div class="top-separate">
    <h1 class="text-title text-center m-0 pb-4">{{ __('Profile information') }}</h1>
    <div class="container-sm container-center mb-5">
        <form action="#" class="pb-4 text-center" id="profile-image-form">
            <input type="file" name="image-input" id="image-input" class="image-input">
            <div class="d-inline-flex position-relative" id="profile-image-container">
                <label for="image-input" class="image-label" data-toggle="tooltip" title="{{ __('Profile picture') }}">
                    <img src="{{ asset('icons/camera.svg') }}" alt="{{ __('Profile picture') }}">
                </label>
                <!-- <button id="btn-delete-profile-image">
                    <svg width="8" height="8" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 10L0 9L4 5L0 1L1 0L5 4L9 0L10 1L6 5L10 9L9 10L5 6L1 10Z" fill="#330136"/>
                    </svg>
                    Eliminar foto
                </button> -->
            </div>
        </form>
        {!! Form::model($user, ['url' => route('user.update', $user), 'method' => 'put', 'id' => 'user-profile-form']) !!}
            <div class="form-group float-input">
                {!! Form::text('name', null, ['id' => 'name-input', 'class' => 'form-control', 'required' => true, 'autofocus' => true]) !!}
                {!! Form::label('name-input', __('validation.attributes.name')) !!}
            </div>
            
            <div class="form-group float-input">
                {!! Form::text('email', null, ['id' => 'email-input', 'class' => 'form-control', 'required' => true]) !!}
                {!! Form::label('email-input', __('validation.attributes.email')) !!}
            </div>

            <div class="form-group float-input">
                {!! Form::select('gender', $genders, null, ['id' => 'gender-input', 'class' => 'select2-single']) !!}
                {!! Form::label('gender-input', __('validation.attributes.gender')) !!}
            </div>

            <div class="form-group d-flex align-items-center">
                <label for="color-input" class="mb-0">{{ __('Message color') }}</label>
                <input type="color" name="message_color" id="color-input" class="ml-2" value="{{ $user->settings['message_color'] ?? '#000000' }}">
            </div>

            <button class="btn btn-block btn-primary" type="button" id="btn-save-profile-changes">{{ __('Save changes') }}</button>
        {!! Form::close() !!}

        <hr class="my-5">

        <div class="options-group">
            <p class="text-subtitle m-0">{{ __('Other settings') }}</p>
            <button class="btn btn-block btn-gray" type="submit">{{ __('Change password') }}</button>
            <button class="btn btn-block btn-outline-danger m-0" type="submit">{{ __('Deactivate account') }}</button>
        </div>
    </div>
</div>
@endsection
