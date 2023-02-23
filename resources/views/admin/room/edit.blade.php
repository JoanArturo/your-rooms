@extends('layouts.app')

@section('page', __('Edit room'))

@section('content')
<h1 class="text-title mt-4 pb-4">{{ __('Edit room') }}</h1>

{!! Form::model($room, ['url' => route('admin.room.update', $room), 'method' => 'put']) !!}
    @include('admin.room.partials._form')
{!! Form::close() !!}
@endsection
