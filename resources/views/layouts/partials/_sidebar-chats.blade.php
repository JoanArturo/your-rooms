<aside class="sidebar" id="sidebar-chats">
    <div class="sidebar-overlay"></div>
    <div class="sidebar-header">
        <p class="sidebar-header-title">{{ numberOfOpenRoomsOfTheCurrentUser() }} Salas abiertas</p>
        <svg class="sidebar-close-icon" width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1 10L0 9L4 5L0 1L1 0L5 4L9 0L10 1L6 5L10 9L9 10L5 6L1 10Z" fill="#330136"/>
        </svg>
    </div>
    <ul class="sidebar-items">
        @forelse (openRoomsOfTheCurrentUser() as $room)
            <li class="sidebar-item" data-sidebaritem="{{ $room->id }}">
                <a href="{{ route('room.show', $room) }}">
                    <span class="sidebar-item-title">{{ $room->name }}</span>
                </a>
                <div class="sidebar-item-options">
                    <span class="sidebar-item-status">{{ $room->presenter()->usersOnlineNumber() }}</span>
                    {!! Form::open(['url' => route('room.leave', $room), 'style' => 'display: inline']) !!}
                        <button class="sidebar-item-btn-close" type="submit">
                            <svg width="6" height="6" viewBox="0 0 6 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.7618 1.29581C5.82293 1.23882 5.87224 1.17034 5.9069 1.09429C5.94157 1.01824 5.96092 0.936112 5.96384 0.852586C5.96677 0.76906 5.95321 0.685775 5.92395 0.607487C5.89469 0.5292 5.8503 0.457443 5.7933 0.396312C5.73631 0.335182 5.66783 0.285876 5.59178 0.251209C5.51573 0.216543 5.4336 0.197195 5.35008 0.19427C5.26655 0.191344 5.18326 0.2049 5.10498 0.234162C5.02669 0.263424 4.95493 0.307819 4.8938 0.364812L3.0318 2.10081L1.2958 0.238176C1.17964 0.119204 1.02154 0.0504212 0.855308 0.0465446C0.68908 0.0426681 0.527937 0.104006 0.40636 0.217434C0.284783 0.330861 0.212429 0.487368 0.204781 0.653465C0.197134 0.819562 0.254799 0.982056 0.365438 1.10618L2.10144 2.96818L0.238802 4.70418C0.175512 4.76059 0.124134 4.82909 0.0876856 4.90563C0.0512369 4.98218 0.0304521 5.06525 0.0265524 5.14994C0.0226528 5.23463 0.0357165 5.31925 0.0649767 5.39883C0.0942368 5.4784 0.139103 5.55133 0.196941 5.61332C0.254778 5.67531 0.324421 5.72512 0.401777 5.75983C0.479134 5.79453 0.562646 5.81342 0.647406 5.8154C0.732167 5.81738 0.816468 5.8024 0.895359 5.77134C0.974249 5.74028 1.04614 5.69377 1.1068 5.63454L2.9688 3.89918L4.7048 5.76118C4.76085 5.82563 4.82931 5.87815 4.90609 5.91559C4.98287 5.95302 5.0664 5.97462 5.15171 5.97909C5.23701 5.98356 5.32234 5.97081 5.40262 5.94159C5.48289 5.91238 5.55646 5.86731 5.61894 5.80906C5.68142 5.75081 5.73153 5.68057 5.76629 5.60254C5.80105 5.52451 5.81974 5.44029 5.82126 5.35488C5.82277 5.26947 5.80708 5.18463 5.77511 5.10542C5.74313 5.02621 5.69554 4.95424 5.63517 4.89381L3.8998 3.03181L5.7618 1.29581Z" fill="white"/>
                            </svg>
                        </button>
                    {!! Form::close() !!}
                </div>
            </li>
        @empty
            <li class="p-2">{{ __('You have not joined any rooms.') }}</li>
        @endforelse
    </ul>
</aside>