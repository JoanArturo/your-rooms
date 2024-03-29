<div class="col-12 col-md-4 col-room">
    <div class="card card-room" data-cardroom="{{ $room->id }}">
        <div class="card-body">
            <p class="card-title text-tertiary"><strong>{{ $room->name }}</strong></p>
            <p>{{ $room->presenter()->description(120) }}</p>
            <div class="d-flex align-items-center">
                <div class="card-user-number mr-4">
                    <small>
                        <span>{{ $room->presenter()->usersOnlineNumber() }}</span>
                        <span> / {{ $room->limit }}</span>
                    </small>
                    <img src="{{ asset('icons/users.svg') }}" alt="Users icon">
                </div>
                <i><small>{{ __('Created') }} {{ $room->presenter()->createdAt() }}</small></i>
            </div>
            <a href="{{ route('room.show', $room) }}" class="card-options">
                <span>{{ __('Join the room') }} <i class="ri-arrow-right-line"></i></span>
            </a>
        </div>
    </div>
</div>