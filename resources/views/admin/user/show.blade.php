@extends('layouts.app')

@section('page', __('User details'))

@section('content')
<div class="card details-card my-4 rounded">
    <div class="card-header">
        <div class="details-image">
            {{ $user->presenter()->profilePicture() }}
        </div>
        <h1 class="text-title m-0">{{ $user->name }}</h1>
        <p class="m-0">{{ $user->presenter()->role() }}</p>
    </div>
    <div class="card-body">
        <div class="details-info">
            <p><strong>{{ __('validation.attributes.name') }}</strong></p>
            <p>{{ $user->name }}</p>
        </div>
        <div class="details-info">
            <p><strong>{{ __('validation.attributes.email') }}</strong></p>
            <p>{{ $user->email }}</p>
        </div>
        <div class="details-info">
            <p><strong>{{ __('validation.attributes.role') }}</strong></p>
            <p>{{ $user->presenter()->role() }}</p>
        </div>
        <div class="details-info">
            <p><strong>{{ __('validation.attributes.account_status') }}</strong></p>
            {{ $user->presenter()->status() }}
        </div>
        <div class="details-info">
            <p><strong>{{ __('Registration date') }}</strong></p>
            <p>{{ $user->presenter()->createdAt() }}</p>
        </div>
        <div class="details-info">
            <p>
                <strong>{{ __('Num. reports') }}</strong>
                @if ($user->number_of_reports_against >= 1)
                    <a class="btn btn-link p-0 ml-2" data-toggle="collapse" href="#collapseReportedMessages" role="button" aria-expanded="false" aria-controls="collapseReportedMessages">
                        {{ __('View reported messages') }}
                    </a>
                @endif
            </p>
            <p>{{ $user->number_of_reports_against }}</p>
        </div>
        @if ($user->number_of_reports_against >= 1)
            <div class="details-info collapse" id="collapseReportedMessages">
                <p><strong>{{ __('Reported messages') }}</strong></p>
                @foreach ($user->messages_reported_against as $message)
                    <div class="card card-body px-3 py-2 mb-1">
                        {{ $message->body }}
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    <div class="card-footer">
        <a href="{{ route('admin.user.index') }}" class="btn btn-gray"><i class="ri-arrow-left-s-line mr-2"></i> {{ __('Back to the list of users') }}</a>
        @if ($user->is_banned)
            <button class="btn btn-info" onclick="document.getElementById('unban-form').submit()"><i class="ri-forbid-line mr-2"></i> {{ __('Unban account') }}</button>

            {!! Form::open(['url' => route('admin.user.updateBanStatus', [$user, 0]), 'id' => 'unban-form', 'styles' => 'display: none;']) !!}
            {!! Form::close() !!}
        @else
            <button class="btn btn-danger" onclick="document.getElementById('ban-form').submit()"><i class="ri-forbid-line mr-2"></i> {{ __('Ban account') }}</button>

            {!! Form::open(['url' => route('admin.user.updateBanStatus', [$user, 1]), 'id' => 'ban-form', 'styles' => 'display: none;']) !!}
            {!! Form::close() !!}
        @endif
    </div>
</div>
@endsection
