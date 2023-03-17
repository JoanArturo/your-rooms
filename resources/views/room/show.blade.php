@extends('layouts.app')

@section('page', 'Chat (' . $room->name . ')')

@section('alerts', '')

@section('content')
<div class="row">
    <div class="col-12 col-md-9">   
        <p class="text-container-title">{{ __('Connected to the room') }} <strong>{{ $room->name }}</strong></p>
        <div class="messages-container">
            @foreach ($room->messages->reverse() as $message)
                @message(['message' => $message])
                @endmessage
            @endforeach
            <div class="typing-text">
                <p><span class="typing-text-user">Username</span> esta escribiendo</p>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        {!! Form::open(['url' => route('room.sendMessage', $room), 'id' => 'message-form']) !!}
            {!! Form::text('message', null, ['id' => 'message-input', 'placeholder' => 'Escribe un mensaje...', 'autofocus' => 'true', 'autocomplete' => 'off']) !!}
            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5.6244 11.4607C5.48315 11.3194 5.40918 11.1396 5.4025 10.9213C5.39634 10.703 5.46388 10.5233 5.60514 10.382L9.38042 6.60674H0.770465C0.552167 6.60674 0.369053 6.53278 0.221124 6.38485C0.073708 6.23743 0 6.05457 0 5.83628C0 5.61798 0.073708 5.43486 0.221124 5.28693C0.369053 5.13952 0.552167 5.06581 0.770465 5.06581H9.38042L5.60514 1.29053C5.46388 1.14928 5.39634 0.969502 5.4025 0.751204C5.40918 0.532905 5.48315 0.35313 5.6244 0.211878C5.76565 0.0706257 5.94543 0 6.16372 0C6.38202 0 6.5618 0.0706257 6.70305 0.211878L11.7881 5.29695C11.8652 5.36116 11.9199 5.44128 11.9522 5.53734C11.9841 5.6339 12 5.73355 12 5.83628C12 5.939 11.9841 6.03531 11.9522 6.1252C11.9199 6.21509 11.8652 6.29855 11.7881 6.3756L6.70305 11.4607C6.5618 11.6019 6.38202 11.6726 6.16372 11.6726C5.94543 11.6726 5.76565 11.6019 5.6244 11.4607Z" fill="#BDBDBD"/>
            </svg>
        {!! Form::close() !!}
    </div>
    <div class="col-12 col-md-3 d-none d-md-block">
        <p class="text-users-connected">
            <img src="{{ asset('icons/users.svg') }}" alt="Users icon" class="mr-1">
            <span>{{ $room->presenter()->usersOnlineNumber() }}</span> {{ __('Users online') }}
        </p>
        <div class="users-container">
            @carduser(['user' => Auth::user()])
            @endcarduser

            @foreach ($users as $user)
                @carduser(['user' => $user])
                @endcarduser
            @endforeach
        </div>
    </div>
</div>
@endsection


@section('js')
    <script>
        window.settings = {
            user: {
                id: {!! Auth::user()->id !!},
                name: "{!! Auth::user()->name !!}",
                settings: {!! json_encode(Auth::user()->settings) !!},
                profilePicture: "{!! Auth::user()->presenter()->profilePicture() !!}"
            },
            room: {
                id: {!! $room->id !!},
                name: "{!! $room->name !!}",
                description: "{!! $room->description !!}"
            }
        };
    </script>
@endsection