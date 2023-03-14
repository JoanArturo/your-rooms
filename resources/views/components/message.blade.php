<div class="message">
    <div class="avatar-group">
        <div class="avatar-image">
            {{ $message->user->presenter()->profilePicture() }}
        </div>
    </div>
    <div>
        <p class="message-user"><strong>{{ $message->user->name }}</strong></p>
        <div class="d-flex flex-wrap">
            <p class="message-body mr-2" style="background-color: {{ $message->user->presenter()->messageColor() }}">{{ $message->body }}</p>
            <small class="message-time">{{ __('Sent') }} {{ $message->created_at->diffForHumans() }}</small>
        </div>
    </div>
</div>