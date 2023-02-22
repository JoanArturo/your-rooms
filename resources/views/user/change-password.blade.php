@extends('layouts.app')

@section('page', 'Cambiar contraseña')

@section('content')
<div class="top-separate">
    <h1 class="text-title text-center m-0 pb-4 mb-2">Cambiar contraseña</h1>
    <div class="container-sm container-center">
        <form action="#">
            <div class="form-group float-input">
                <input type="password" id="new-password-input" class="form-control" required>
                <label for="#new-password-input">Nueva contraseña</label>
            </div>
            <div class="form-group float-input">
                <input type="password" id="repeat-password-input" class="form-control" required>
                <label for="#repeat-password-input">Repetir contraseña</label>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <button class="btn btn-block btn-primary" type="submit">Guardar</button>
                <a class="btn btn-block btn-gray m-0 ml-2" href="#">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
