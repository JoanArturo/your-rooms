<div class="user" data-userid="{{ $user->id }}">
    <div class="avatar-group">
        <div class="avatar-image">
            {{ $user->presenter()->profilePicture() }}
        </div>
        <a class="text-dark" href="{{ route('user.profile', $user) }}">{{ $user->name }}</a>
    </div>
    <div class="badge-user-status bg-{{ $user->presenter()->activeColor() }}" title="{{ $user->presenter()->activeText() }}"></div>
</div>