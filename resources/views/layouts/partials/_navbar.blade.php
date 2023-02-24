<nav class="navbar navbar-expand navbar-light bg-light">
    <div class="container d-flex align-items-center justify-content-between">
        <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
        @if (Auth::user()->isVerified())
            <div class="collapse navbar-collapse flex-grow-0" id="navbar-nav-container">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="#"><img src="{{ asset('icons/home.svg') }}" alt="Home icon"> <span class="nav-link-text">Inicio</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="nav-link-rooms" href="javascript:void(0)"><img src="{{ asset('icons/rooms.svg') }}" alt="Rooms icon"> <span class="nav-link-text">Salas</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="nav-link-chats" href="javascript:void(0)">
                            <img src="{{ asset('icons/chats.svg') }}" alt="Chats icon"> <span class="nav-link-text">Chats</span>
                            <span class="badge badge-gray badge-number">10</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="btn-group dropdown-avatar">
                <div class="avatar-group" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="avatar-image">
                        {{ $user->presenter()->profilePicture() }}
                    </div>
                    <img src="{{ asset('icons/arrow-down.svg') }}" alt="Arrow down icon">
                </div>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="./users-index.html">Listado de usuarios</a>
                    <a class="dropdown-item" href="./rooms-index.html">Listado de salas</a>
                    <hr class="m-0">
                    <button class="dropdown-item" type="button">Sugerencias</button>
                    <button class="dropdown-item" type="button">Información de perfil</button>
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