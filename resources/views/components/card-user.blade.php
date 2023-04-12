<div class="user" data-userid="{{ $user->id }}">
    <div class="avatar-group">
        <div class="avatar-image">
            {{ $user->presenter()->profilePicture() }}
        </div>
        <p class="m-0">{{ $user->name }}</p>
    </div>
    <div class="badge-user-status bg-{{ $user->presenter()->activeColor() }}" title="{{ $user->presenter()->activeText() }}"></div>
</div>