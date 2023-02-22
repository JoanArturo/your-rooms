@extends('layouts.app')

@section('page', 'Crear usuario')

@section('content')
<h1 class="text-title mt-4 pb-4">Formulario de usuario</h1>

<form action="#">
    <div class="form-row">
        <div class="col-12 col-md-6">
            <div class="form-group float-input">
                <input type="text" id="username-input" class="form-control" required autofocus>
                <label for="#username-input">Nombre</label>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group float-input">
                <input type="text" id="email-input" class="form-control" required>
                <label for="#email-input">E-mail</label>
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="col-12 col-md-6">
            <div class="form-group float-input">
                <input type="password" id="password-input" class="form-control" required>
                <label for="#password-input">Contraseña</label>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group float-input">
                <input type="password" id="password-input" class="form-control" required>
                <label for="#password-input">Repetir contraseña</label>
            </div>
        </div>
    </div>

    <div class="form-group float-input">
        <select name="role-input" id="role-input" class="select2-single">
            <option value="0" selected>Seleccione un rol</option>
            <option value="1">Administrador</option>
            <option value="2">Usuario</option>
        </select>
        <label for="#role-input">Rol</label>
    </div>

    <div class="form-group float-input">
        <select name="status-input" id="status-input" class="select2-single">
            <option value="0" selected>Seleccione un estado</option>
            <option value="1">Activo</option>
            <option value="2">Baneado</option>
        </select>
        <label for="#status-input">Estado de la cuenta</label>
    </div>
    
    <div class="d-flex align-items-center">
        <a class="btn btn-gray mr-2" type="submit" href="./users-index.html">Regresar al listado</a>
        <button class="btn btn-primary" type="submit">Guardar</button>
    </div>
</form>
@endsection
