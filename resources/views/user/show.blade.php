@extends('layouts.app')

@section('page', 'Información del perfil')

@section('content')
<div class="top-separate">
    <h1 class="text-title text-center m-0 pb-4">Información del perfil</h1>
    <div class="container-sm container-center mb-5">
        <form action="#" class="pb-4 text-center" id="profile-image-form">
            <input type="file" name="image-input" id="image-input" class="image-input">
            <div class="d-inline-flex position-relative" id="profile-image-container">
                <label for="image-input" class="image-label" data-toggle="tooltip" title="Foto de perfil">
                    <img src="{{ asset('icons/camera.svg') }}" alt="User profile image">
                </label>
                <!-- <button id="btn-delete-profile-image">
                    <svg width="8" height="8" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 10L0 9L4 5L0 1L1 0L5 4L9 0L10 1L6 5L10 9L9 10L5 6L1 10Z" fill="#330136"/>
                    </svg>
                    Eliminar foto
                </button> -->
            </div>
        </form>
        <form action="./verify-account.html">
            <div class="form-group float-input">
                <input type="text" id="username-input" class="form-control" value="User example" required>
                <label for="#username-input">Username</label>
            </div>
            <div class="form-group float-input">
                <input type="text" id="email-input" class="form-control" value="userexample@example.com" required>
                <label for="#email-input">E-mail</label>
            </div>
            <div class="form-group float-input">
                <select name="gender-input" id="gender-input" class="select2-single">
                    <option value="0" selected>Seleccione su genero</option>
                    <option value="1">Masculino</option>
                    <option value="2">Femenino</option>
                </select>
                <label for="#gender-input">Genero</label>
            </div>
            <div class="form-group d-flex align-items-center">
                <label for="color-input" class="mb-0">Color de mensajes</label>
                <input type="color" name="color-input" id="color-input" class="ml-2">
            </div>
            <button class="btn btn-block btn-primary" type="submit">Guardar cambios</button>
        </form>

        <hr class="my-5">

        <div class="options-group">
            <p class="text-subtitle m-0">Otros ajustes</p>
            <button class="btn btn-block btn-gray" type="submit">Cambiar contraseña</button>
            <button class="btn btn-block btn-outline-danger m-0" type="submit">Desactivar cuenta</button>
        </div>
    </div>
</div>
@endsection
