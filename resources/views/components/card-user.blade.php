<div class="user">
    <div class="avatar-group">
        <div class="avatar-image">
            {{ $user->presenter()->profilePicture() }}
        </div>
        <p class="m-0">{{ $user->name }}</p>
    </div>
    <div class="badge-user-status" style="background-color: {{ $user->presenter()->messageColor() }}"></div>
</div>