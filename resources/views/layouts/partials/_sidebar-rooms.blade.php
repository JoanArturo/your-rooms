<aside class="sidebar" id="sidebar-rooms">
    <div class="sidebar-overlay"></div>
    <div class="sidebar-header">
        <p class="sidebar-header-title">{{ activeRoomsNumber() }} {{ __('Rooms available') }}</p>
        <svg class="sidebar-close-icon" width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1 10L0 9L4 5L0 1L1 0L5 4L9 0L10 1L6 5L10 9L9 10L5 6L1 10Z" fill="#330136"/>
        </svg>
    </div>
    <ul class="sidebar-items">
        @foreach (allRooms() as $room)
            <li class="sidebar-item" data-sidebaritem="{{ $room->id }}">
                <a href="{{ route('room.show', $room) }}">
                    <span class="sidebar-item-title">{{ $room->name }}</span><span class="sidebar-item-status">{{ $room->presenter()->usersOnlineNumber() }}</span>
                </a>
            </li>
        @endforeach
    </ul>
</aside>