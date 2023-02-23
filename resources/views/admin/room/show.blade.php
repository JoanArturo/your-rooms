@extends('layouts.app')

@section('page', __('Room details'))

@section('content')
<div class="card details-card my-4 rounded">
    <div class="card-header">
        <h1 class="text-title m-0">{{ __('Room') }} | {{ $room->name }}</h1>
        <p class="m-0">{{ $room->presenter()->usersOnlineNumber() }} usuarios conectados</p>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="details-info">
                    <p><strong>{{ __('validation.attributes.name') }}</strong></p>
                    <p>{{ $room->name }}</p>
                </div>
                <div class="details-info">
                    <p><strong>{{ __('validation.attributes.description') }}</strong></p>
                    <p>{{ $room->description }}</p>
                </div>
                <div class="details-info">
                    <p><strong>{{ __('validation.attributes.limit') }}</strong></p>
                    <p>{{ $room->limit }}</p>
                </div>
                <div class="details-info">
                    <p><strong>{{ __('Users online') }}</strong></p>
                    {{ $room->presenter()->usersOnlineNumberWithIndicator() }}
                </div>
                <div class="details-info">
                    <p><strong>{{ __('Room status') }}</strong></p>
                    {{ $room->presenter()->status() }}
                </div>
                <div class="details-info">
                    <p><strong>{{ __('Registration date') }}</strong></p>
                    <p>{{ $room->presenter()->createdAt() }}</p>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="details-info users-list mt-3 mt-md-0">
                    <p><strong>{{ __('List of connected users') }}</strong></p>
                    <ol>
                        @forelse ($room->users as $user)
                            <li>
                                <span>{{ $user->name }}</span>
                                <a class="text-danger ml-2" href="#" data-toggle="modal" data-target="#removeUser">{{ __('Expel') }}</a>
                            </li>
                        @empty
                            <li>{{ __('No users connected') }}</li>
                        @endforelse
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="{{ route('admin.room.index') }}" class="btn btn-gray"><i class="ri-arrow-left-s-line mr-2"></i> {{ __('Back to the list of rooms') }}</a>
    </div>
</div>

<!-- Modal Remove User From Room -->
<div class="modal fade" id="removeUser" tabindex="-1" role="dialog" aria-labelledby="removeUserLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title" id="removeUserLabel">{{ __('Expel user') }}</h5>
            </div>
            <div class="modal-body py-4">
                <p class="m-0">{!! __('Are you sure to expel user <strong>:name</strong> out of this room?', ['name' => 'Mark']) !!}</p>
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-gray" data-dismiss="modal">{{ __('No, cancel') }}</button>
                <button type="button" class="btn btn-danger">{{ __('Yes, expel') }}</button>
            </div>
        </div>
    </div>
</div>
@endsection
