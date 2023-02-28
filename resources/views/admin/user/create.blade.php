@extends('layouts.app')

@section('page', __('Create user'))

@section('content')
<h1 class="text-title mt-4 pb-4">{{ __('Create user') }}</h1>

{!! Form::open(['url' => route('admin.user.store')]) !!}
    @include('admin.user.partials._form')
{!! Form::close() !!}
@endsection
