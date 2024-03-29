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
                    $(imagePreview).attr('src', this.result).addClass('has-profile-image');

                    // Change navbar icon
                    $('.avatar-image img').attr('src', this.result).addClass('has-profile-image');
                });
            }

            uploadProfilePicture();

            createButtonDeleteProfileImage();
        });
    }

    const uploadProfilePicture = () => {
        let form = $('#profile-image-form');
        let url = $(form).attr('action');
        let formData = new FormData($(form)[0]);

        $('.messages-status').html(
            getLoadingMessageHtml('Cambiando foto de perfil...')
        );

        axios.post(url, formData)
            .then( (response) => {
                if (response.status == 200) {
                    $('.messages-status').html(
                        getSuccessMessage(response.data.status_message)
                    );
                    
                    // Remove the No Images column from the photo gallery
                    if ($('#col-no-images').length > 0)
                        $('#col-no-images').remove();

                    // Add image to gallery
                    $(`
                        <div class="col-6 col-md-2">
                            <img src="${location.origin}/storage/${response.data.image.path}" alt="Photo ${response.data.image.id}" class="gallery-image" data-url="/image/${response.data.image.id}">
                        </div>
                    `).insertAfter('#col-upload-photo');

                    // Update user profile avatar image
                    $('.image-label img').attr('src', `${location.origin}/storage/${response.data.image.path}`);

                    // Update number of photos
                    let photoNumberText = $('#photo-number-text').find('span');
                    $(photoNumberText).html(parseInt(photoNumberText.text()) + 1);
                }
            })
            .catch( (error) => {
                $('.messages-status').html(
                    getErrorsMessageHtml(error)
                );
            });
    }

    const createButtonDeleteProfileImage = () => {
        $('#profile-image-form #profile-image-container').append(`
            <button type="button" id="btn-delete-profile-image">
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
                $(e.target).hide();
                deleteProfilePicture();
            }
        });
    }

    const deleteProfilePicture = () => {
        $('.messages-status').html(
            getLoadingMessageHtml('Eliminando foto de perfil...')
        );

        axios.delete('/user/delete-profile-picture')
            .then( (response) => {
                if (response.status == 200) {
                    $('.messages-status').html(
                        getSuccessMessage(response.data.status_message)
                    );

                    let imagePath = $('.image-label img').attr('src');
                    
                    // Remove main avatar image
                    $('#profile-image-form').trigger('reset');
                    $('.image-label img').attr('src', '/icons/camera.svg').removeClass('has-profile-image');
                    
                    // Change navbar icon
                    $('.avatar-image img').attr('src', '/icons/camera.svg').removeClass('has-profile-image');
                    
                    // Remove image from gallery
                    $(`img[src="${imagePath}"]`).parent().remove();

                    // Add the column No Images of the photo gallery
                    if ($('#gallery .row').children().length <= 1) {
                        $('#gallery .row').append(`
                            <div class="col-6 col-md-2 d-flex align-items-center justify-content-center" id="col-no-images">
                                <p class="m-0">Sin imágenes</p>
                            </div>
                        `);
                    }

                    // Remove delete image button
                    $('#btn-delete-profile-image').remove();

                    // Update number of photos
                    let photoNumberText = $('#photo-number-text').find('span');
                    $(photoNumberText).html(parseInt(photoNumberText.text()) - 1);
                }
            })
            .catch( (error) => {
                $('.messages-status').html(
                    getErrorsMessageHtml(error)
                );
                
                // Show delete image button
                $('#btn-delete-profile-image').show();
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

                    location.href = '/email/verify';
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

    const getSuccessMessage = (message) => {
        return `
            <div class="alert alert-success mb-4">
                <p class="m-0">${message}</p>
            </div> 
        `;
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

    const initializeEventLoadMoreRooms = () => {
        $('#btn-load-more-rooms').click( (e) => {
            let currentPage = $(e.delegateTarget).data('current-page');
            let nextPage = currentPage + 1;
            let url = '/room/show-more?page=' + nextPage;
            let hasMorePages = true;

            // Disable button
            $(e.delegateTarget).attr('disabled', true);

            // Show a spinner load
            $('#rooms-list').append(`
                <div class="col-12 col-md-4 d-flex align-items-center justify-content-center py-3" id="message-loading-room">
                    ${getLoadingMessageHtml('Cargando salas...')}
                </div>
            `);

            axios.get(url)
                .then( (response) => {
                    // Hidden spinner load
                    $('#rooms-list').find('#message-loading-room').remove();
                    
                    // Add new items
                    $('#rooms-list').append(response.data.elements);

                    hasMorePages = response.data.hasMorePages;

                    // Update the state of the Load More Rooms button
                    if (hasMorePages) {
                        $(e.delegateTarget).find('span').html(`(${response.data.page.total - response.data.page.to})`);
                        $(e.delegateTarget).data('current-page', nextPage);
                    } else {
                        $(e.delegateTarget).remove();
                    }

                    // Disable button
                    $(e.delegateTarget).attr('disabled', false);
                })
                .catch( (error) => {
                    $('.errors-container').html(
                        getErrorsMessageHtml(error)
                    );

                    // Disable button
                    $(e.delegateTarget).attr('disabled', false);

                    // Hidden spinner load
                    $('#rooms-list').find('#message-loading-room').remove();
                });
        });
    }

    const initializeEventSaveProfileChanges = () => {
        $('#btn-save-profile-changes').click( (e) => {
            let url = $('#user-profile-form').attr('action');
            let formData = $('#user-profile-form').serialize();

            $('.messages-status').html(
                getLoadingMessageHtml('Guardando cambios...')
            );

            axios.put(url, formData)
                .then( (response) => {
                    if (response.status == 200) {
                        $('.messages-status').html(
                            getSuccessMessage(response.data.status_message)
                        );
                    }
                })
                .catch( (error) => {
                    $('.messages-status').html(
                        getErrorsMessageHtml(error)
                    );
                });
        });
    }

    const detectChangesInTheRoomFormNameInput = () => {
        const inputExists = $('#name-input').length > 0;
        
        if (inputExists)
            $('#name-input').stringToSlug({
                setEvents: 'keyup',
                getPut: '#slug-input',
            });
    }

    const initializeEventReportMessage = () => {
        $('.messages-container').click( (e) => {
            let isButtonReportMessage = $(e.target).hasClass('btn-report-message');

            if (isButtonReportMessage) {
                let buttonReportMessage = $(e.target);
                let url = $(buttonReportMessage).data('url');

                $(buttonReportMessage).closest('.btn-group')
                    .find('.dropdown-toggle')
                    .attr('disabled', true);
    
                axios.post(url, [])
                    .then( ({ status, data }) => {
                        if (status == 200) {
                            $(buttonReportMessage).closest('.message')
                                .find('.message-body')
                                .hide()
                                .html(data.message)
                                .fadeIn();
                            
                            $(buttonReportMessage).closest('.btn-group').remove();
                        }
                    })
                    .catch( (error) => {
                        $(buttonReportMessage).closest('.btn-group')
                            .find('.dropdown-toggle')
                            .removeAttr('disabled');
                    });
            }
        });
    }

    const initializeEventShowImage = () => {
        $('#gallery').click( (e) => {
            const isImage = $(e.target).hasClass('gallery-image');

            if (isImage) {
                let url = $(e.target).data('url');
                let imageParent = e.target.parentElement;

                // Add spinner load if it doesn't exist
                if ($(imageParent).find('.spinner-load-image').length <= 0) {
                    $(imageParent).append(`
                        <div class="spinner-load-image">
                            <div class="spinner-border" role="status" aria-hidden="true"></div>
                            <span>Cargando...</span>
                        </div>
                    `);
                }

                axios.get(url)
                    .then( (response) => {
                        $('#modal-container').html(response.data);
                        $('#modal-container .modal').modal('show');
                        
                        // Remove spinner load
                        $(imageParent).find('.spinner-load-image').remove();
                    })
                    .catch( (error) => {
                        $('.errors-container').html(
                            getErrorsMessageHtml(error)
                        );

                        // Remove spinner load
                        $(imageParent).find('.spinner-load-image').remove();
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
    initializeEventLoadMoreRooms();
    initializeEventSaveProfileChanges();
    detectChangesInTheRoomFormNameInput();
    initializeEventReportMessage();
    initializeEventShowImage();
});