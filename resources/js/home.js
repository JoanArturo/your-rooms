$(() => {
    const initializeSocketHome = () => {
        const pathname = location.pathname;

        // Verify that the user is not in the login view
        if (pathname === '/')
            return;

        Echo.private(`home`)
            .listen('UserJoinedARoom', (e) => {                
                // Update the number of connected users text in the sidebar
                $(`.sidebar-item[data-sidebaritem=${e.room.id}] .sidebar-item-status`).html(e.room.users.length);
                
                // Update the number of connected users text on the room card
                $(`.card-room[data-cardroom=${e.room.id}]`)
                    .find('.card-user-number small > span')
                    .first()
                    .html(e.room.users.length);
            })
            .listen('UserLeftARoom', (e) => {
                // Update the number of connected users text in the sidebar
                $(`.sidebar-item[data-sidebaritem=${e.room.id}] .sidebar-item-status`).html(e.room.users.length);

                // Update the number of connected users text on the room card
                $(`.card-room[data-cardroom=${e.room.id}]`)
                    .find('.card-user-number small > span')
                    .first()
                    .html(e.room.users.length);
            });
    }

    initializeSocketHome();
});