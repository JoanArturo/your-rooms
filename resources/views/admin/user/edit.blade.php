@extends('layouts.app')

@section('page', __('Edit user'))

@section('content')
<h1 class="text-title mt-4 pb-4">{{ __('Edit user') }}</h1>

{!! Form::model($user, ['url' => route('admin.user.update', $user), 'method' => 'put']) !!}
    @include('admin.user.partials._form')
{!! Form::close() !!}
@endsection
