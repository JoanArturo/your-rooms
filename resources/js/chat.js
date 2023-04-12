$(() => {
    let typingTimer;

    const initializeEventSendMessage = () => {
        let form = $('#message-form');

        $(form).on('submit', (e) => {
            e.preventDefault();
            let message = $('#message-input').val();

            if (message) {
                let formData = $(form).serialize();
                let url = $(form).attr('action');

                let messageDOM = $(
                    getMessageComponentInHtml(
                        settings.user.profilePicture,
                        settings.user.name,
                        settings.user.settings.message_color + '85', // Alpha color
                        message,
                        'Enviando...'
                    )
                ).prependTo('.messages-container');
                
                $(form).trigger('reset');
                
                axios.post(url, formData)
                    .then( (response) => {
                        if (response.status == 200) {
                            $(messageDOM).find('.message-body').css('background-color', settings.user.settings.message_color);
                            $(messageDOM).find('.message-time').html(response.data.message.created_at);
                        }
                    });
            }
        });
    }

    const initializeEventClickSendMessageButton = () => {
        $('#btn-send-message').on('click', () => {
            $('#message-form').submit();
        });
    }

    const getMessageComponentInHtml = (profilePicture, username, color, messageText, time) => {
        return `
        <div class="message">
            <div class="avatar-group">
                <div class="avatar-image">
                    ${profilePicture}
                </div>
            </div>
            <div>
                <p class="message-user"><strong>${username}</strong></p>
                <div class="d-flex flex-wrap">
                    <p class="message-body mr-2" style="background-color: ${color}">${messageText}</p>
                    <small class="message-time">${time}</small>
                </div>
            </div>
        </div>
        `;
    }

    const initializeSocket = () => {
        try {
            if (settings) {
                Echo.private(`room.${settings.room.id}`)
                    .listen('MessageWasSent', (e) => {
                        $('.messages-container').prepend(e.component);
                    })
                    .listen('UserJoinedARoom', (e) => {
                        // Update the number of connected users text
                        $('.text-users-connected span').html(e.room.users.length);
                        
                        // Update the number of connected users text in the sidebar
                        $(`.sidebar-item[data-sidebaritem=${e.room.id}] .sidebar-item-status`).html(e.room.users.length);

                        // Add the card of the connected user
                        $(e.component).hide().appendTo('.users-container').fadeIn();
                    })
                    .listen('UserLeftARoom', (e) => {
                        // Update the number of connected users text
                        $('.text-users-connected span').html(e.room.users.length);

                        // Update the number of connected users text in the sidebar
                        $(`.sidebar-item[data-sidebaritem=${e.room.id}] .sidebar-item-status`).html(e.room.users.length);

                        // Remove the card of the disconnected user
                        $(`div[data-userid=${e.user.id}]`).remove();
                    })
                    .listen('UserIsLoggedIn', (e) => {
                        changeUserActiveStatus(e.user, e.activeText, true);
                    })
                    .listen('UserLoggedOut', (e) => {
                        changeUserActiveStatus(e.user, e.activeText, false);
                    })
                    .listenForWhisper('typing', (e) => {
                        if (e.typing)
                            $('.typing-text').css('display', 'flex');
    
                        $('.typing-text .typing-text-user').html(e.user);
                        
                        hideTypingText();
                    });
            }
        } catch (error) {}
    }

    const hideTypingText = () => {
        clearTimeout(typingTimer);

        typingTimer = setTimeout(() => {
            $('.typing-text').css('display', 'none');
        }, 1000);
    }

    const detectTypingEvent = () => {
        try {
            if (settings) {
                $('#message-input').on('keydown', () => {
                    let channel = Echo.private(`room.${settings.room.id}`);
        
                    setTimeout(() => {
                        channel.whisper('typing', {
                            user: settings.user.name,
                            typing: true
                        });
                    }, 300);
                });
            }
        } catch (error) {}
    }

    const changeUserActiveStatus = (user, text, isOnline = false) => {
        let color = isOnline ? 'bg-success' : 'bg-gray';
        
        $(`.user[data-userid="${user.id}"] .badge-user-status`)
            .removeClass('bg-success bg-gray')
            .addClass(color)
            .attr('title', text);
    }
    
    initializeEventSendMessage();
    initializeEventClickSendMessageButton();
    initializeSocket();
    detectTypingEvent();
});