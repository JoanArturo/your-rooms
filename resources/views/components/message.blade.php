<div class="message">
    <div class="avatar-group">
        <div class="avatar-image">
            {{ $message->user->presenter()->profilePicture() }}
        </div>
    </div>
    <div>
        <p class="message-user"><strong>{{ $message->user->name }}</strong></p>
        <div class="d-flex align-items-center flex-wrap">
            <p class="message-body mr-2" style="background-color: {{ $message->user->presenter()->messageColor() }}">{{ $message->presenter()->body() }}</p>
            <div>
                <small class="message-time">{{ __('Sent') }} {{ $message->created_at->diffForHumans() }}</small>
                
                @if ($showOptions)
                    <div class="btn-group dropup">
                        <button type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ri-settings-3-line"></i> {{ __('Report') }}
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <button class="dropdown-item btn-report-message" type="submit" data-url="{{ route('report.reportMessage', $message) }}">{{ __('Report as inappropriate message/content') }}</button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>