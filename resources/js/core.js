$(() => {
    const initializeLibraries = () => {
        $('.select2-single').select2();
        $('[data-toggle="tooltip"]').tooltip();
    }

    const activeLoginOrRegisterSectionToLoadPage = () => {
        let hash = $(location).prop('hash');

        if (hash == '#login') {
            showLoginForm();
            hideRegisterForm();
        } else if (hash == '#register') {
            hideLoginForm();
            showRegisterForm();
        }
    }

    const initializeEventGoLogin = () => {
        $('#btn-go-login').click( e => {
            // e.preventDefault();
            showLoginForm();
            hideRegisterForm();
        });
    }

    const showLoginForm = () => {
        $('#login-form')
            .show()
            .animate({
                left: '50%',
                opacity: 1,
            }, 'fast');
    }

    const hideRegisterForm = () => {
        $('#register-form')
            .animate({
                left: '120%',
                opacity: 0
            }, 'fast', function() {
                $(this).css('display', 'none');
            });
    }
    
    const initializeEventGoRegister = () => {
        $('#btn-go-register').click( e => {
            // e.preventDefault();
            hideLoginForm();
            showRegisterForm();
        });
    }

    const hideLoginForm = () => {
        $('#login-form')
            .animate({
                left: '-20%',
                opacity: 0
            }, 'fast', function() {
                $(this).css('display', 'none');
            });
    }

    const showRegisterForm = () => {
        $('#register-form')
            .show()
            .animate({
                left: '50%',
                opacity: 1
            }, 'fast');
    }
    
    const initializeEventShowSidebarRooms = () => {
        $('#nav-link-rooms, #sidebar-rooms .sidebar-close-icon, #sidebar-rooms .sidebar-overlay').click( e => {
            $('#sidebar-chats').removeClass('show');
            $('#sidebar-rooms').toggleClass('show');
        });
    }
   
    const initializeEventShowSidebarChats = () => {
        $('#nav-link-chats, #sidebar-chats .sidebar-close-icon, #sidebar-chats .sidebar-overlay').click( e => {
            $('#sidebar-rooms').removeClass('show');
            $('#sidebar-chats').toggleClass('show');
        });
    }

    const renderProfileImageToSelectAImage = () => {
        const imageInput = $('#image-input');
        const imagePreview = $('.image-label img');

        $(imageInput).on('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                const fileReader = new FileReader();
                fileReader.readAsDataURL(file);
                
                $(fileReader).on('load', function() {
                    $(imagePreview).attr('src', this.result).addClass('image-selected');

                    // Change navbar icon
                    $('.avatar-image img').attr('src', this.result).addClass('has-profile-image');
                });
            }

            createButtonDeleteProfileImage();
        });
    }

    const createButtonDeleteProfileImage = () => {
        $('#profile-image-form #profile-image-container').append(`
            <button id="btn-delete-profile-image">
                <svg width="8" height="8" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 10L0 9L4 5L0 1L1 0L5 4L9 0L10 1L6 5L10 9L9 10L5 6L1 10Z" fill="#330136"/>
                </svg>
                Eliminar foto
            </button>
        `);
    }

    const initializeEventDeleteProfileImage = () => {
        $('#profile-image-container').click( (e) => {
            const isButton = $(e.target).attr('id') == 'btn-delete-profile-image';

            if (isButton) {
                $('#profile-image-form').trigger('reset');
                $('.image-label img').attr('src', '/icons/camera.svg').removeClass('image-selected');
                $(e.target).remove();
                
                // Change navbar icon
                $('.avatar-image img').attr('src', '/icons/camera.svg').removeClass('has-profile-image');
            }
        });
    }

    const initializeEventCreateAccount = () => {
        $('.login-container').click( (e) => {
            const isButton = $(e.target).attr('id') == 'btn-create-account';

            if (isButton) {
                e.preventDefault();
                $(e.target).attr('disabled', true);
                let formData = $('#register-form form').serialize();

                createUserAccount(formData);
            }
        });
    }

    const createUserAccount = (formData) => {
        showCreateAccountMessage();
        
        axios.post('/register', formData)
            .then( (response) => {
                if (response.status == 200) {
                    $('.errors-container').html(
                        getLoadingMessageHtml('Cuenta creada exitosamente!, redirigiendo...')
                    );

                    location.href = '/home';
                }
            })
            .catch( (error) => {
                $('.errors-container').html(
                    getErrorsMessageHtml(error)
                );

                $('#btn-create-account').attr('disabled', false);
                continueExecutionCreateAccountMessage = false;
            });
    }

    let continueExecutionCreateAccountMessage = true;
    const showCreateAccountMessage = () => {
        continueExecutionCreateAccountMessage = true;

        $('.errors-container').html(
            getLoadingMessageHtml('Creando cuenta...')
        );

        let almostReadyMessage = setTimeout(() => {
            if (continueExecutionCreateAccountMessage) {
                $('.errors-container').html(
                    getLoadingMessageHtml('Ya casi está listo...')
                );
            }
        }, 10000);
    }

    const getLoadingMessageHtml = (text) => {
        return `
            <div class="d-flex align-items-center mb-4">
                <strong>${text}</strong>
                <div class="spinner-border spinner-border-sm ml-2" role="status" aria-hidden="true"></div>
            </div>
        `;
    }

    const getErrorsMessageHtml = (error) => {
        let html = `
            <div class="alert alert-danger mb-4">
                <ul class="m-0 p-0">`;

        if (error.response.data.errors) {
            let errors = Object.values(error.response.data.errors);
            
            errors.forEach( (errorMessage) => {
                html += `<li class="ml-2">${errorMessage}</li>`;
            });
        } else {
            html += `<li class="ml-2">${error}</li>`;
        }
        
        html += '</ul></div>';

        return html;
    }

    const initializeEventDeleteRecord = () => {
        $('.btn-delete-record').click( (e) => {
            let url = $(e.delegateTarget).data('url');

            axios.get(url)
                .then( (response) => {
                    $('#modal-container').html(response.data);
                    $('#modal-container .modal').modal('show');
                })
                .catch( (error) => {
                    $('.errors-container').html(
                        getErrorsMessageHtml(error)
                    );
                });
        });
    }

    const initializeEventConfirmDeleteRecord = () => {
        $('main').click( (e) => {
            const isButton = $(e.target).attr('id') == 'btn-confirm-deletion';

            if (isButton) {
                e.preventDefault();
                let url = $(e.target).data('url');

                $(e.target).closest('.modal').modal('toggle');

                $('.messages-status').html(
                    getLoadingMessageHtml('Eliminando registro...')
                );

                axios.delete(url)
                    .then( (response) => {
                        if (response.status == 204) {
                            $('.messages-status').html(
                                getLoadingMessageHtml('Registro eliminado, refrescando tabla...')
                            );

                            location.reload();
                        }
                    })
                    .catch( (error) => {
                        $('.messages-status').html(
                            getErrorsMessageHtml(error)
                        );
                    });
            }
        });
    }

    initializeLibraries();
    initializeEventGoLogin();
    initializeEventGoRegister();
    activeLoginOrRegisterSectionToLoadPage();
    initializeEventShowSidebarRooms();
    initializeEventShowSidebarChats();
    renderProfileImageToSelectAImage();
    initializeEventDeleteProfileImage();
    initializeEventCreateAccount();
    initializeEventDeleteRecord();
    initializeEventConfirmDeleteRecord();
});