<nav class="navbar navbar-expand navbar-light bg-light">
    <div class="container d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <a class="navbar-brand mr-4" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
            {!! Form::open(['url' => route('room.index'), 'method' => 'get']) !!}
                <div class="search-input-group">
                    {!! Form::text('search', request('search') ?? '', ['class' => 'form-control', 'id' => 'search-input', 'placeholder' => __('Search a room')]) !!}
                    <i class="ri-search-2-line"></i>
                </div>
            {!! Form::close() !!}
        </div>
        @if (Auth::check())
            @if (Auth::user()->isVerified())
                <div class="collapse navbar-collapse flex-grow-0" id="navbar-nav-container">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('room.index') }}"><img src="{{ asset('icons/home.svg') }}" alt="Home icon"> <span class="nav-link-text">{{ __('Home') }}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="nav-link-rooms" href="javascript:void(0)"><img src="{{ asset('icons/rooms.svg') }}" alt="Rooms icon"> <span class="nav-link-text">{{ __('Rooms') }}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="nav-link-chats" href="javascript:void(0)">
                                <img src="{{ asset('icons/chats.svg') }}" alt="Chats icon"> <span class="nav-link-text">Chats</span>
                                <span class="badge badge-gray badge-number">{{ numberOfOpenRoomsOfTheCurrentUser() }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            @endif
            <div class="btn-group dropdown-avatar">
                <div class="avatar-group" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="avatar-image">
                        {{ Auth::user()->presenter()->profilePicture() }}
                    </div>
                    <span>{{ Auth::user()->name }}</span>
                    <img src="{{ asset('icons/arrow-down.svg') }}" alt="Arrow down icon">
                </div>
                <div class="dropdown-menu dropdown-menu-right">
                    @if (Auth::user()->is_admin)
                        <a class="dropdown-item" href="{{ route('admin.user.index') }}">{{ __('Users list') }}</a>
                        <a class="dropdown-item" href="{{ route('admin.room.index') }}">{{ __('Rooms list') }}</a>
                        <a class="dropdown-item" href="{{ route('admin.suggestion.index') }}">{{ __('Suggestions received') }}</a>
                        <a class="dropdown-item" href="{{ route('admin.report.index') }}">{{ __('Reports received') }}</a>
                        <hr class="m-0">
                    @endif

                    @if (Auth::user()->isVerified())
                        <a class="dropdown-item" href="{{ route('suggestion.create') }}">{{ __('Suggestions') }}</a>
                        <a class="dropdown-item" href="{{ route('user.profile', Auth::user()) }}">{{ __('Profile information') }}</a>
                    @endif

                    <button class="dropdown-item text-danger" type="button" 
                        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}                
                    </button>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        @endif
    </div>
</nav>