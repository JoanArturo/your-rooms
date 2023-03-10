@extends('layouts.app')

@section('page', __('Deactivate account'))

@section('content')
<div class="top-separate">
    <h1 class="text-title text-center m-0 pb-4 mb-2">{{ __('Deactivate account') }}</h1>
    <div class="container-sm container-center">
        <p class="text-center pb-4 mb-2">{{ __('By deactivating the account you will lose your profile information and all the messages you have sent in each of the rooms.') }}</p>
        <div class="d-flex align-items-center justify-content-between">
            <button class="btn btn-block btn-primary" type="button" onclick="document.getElementById('user-destroy-form').submit()">{{ __('Ok, deactivate it') }}</button>
            <a class="btn btn-block btn-gray m-0 ml-2" href="{{ route('user.profile') }}">{{ __('Cancel') }}</a>

            {!! Form::open(['url' => route('user.destroy', Auth::user()), 'method' => 'delete', 'id' => 'user-destroy-form', 'style' => 'd-none']) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
