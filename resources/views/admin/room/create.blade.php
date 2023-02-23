@extends('layouts.app')

@section('page', __('Create room'))

@section('content')
<h1 class="text-title mt-4 pb-4">{{ __('Create room') }}</h1>

{!! Form::open(['url' => route('admin.room.store')]) !!}
    @include('admin.room.partials._form')
{!! Form::close() !!}
@endsection
