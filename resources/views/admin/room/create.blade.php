@extends('layouts.app')

@section('page', 'Crear sala')

@section('content')
<h1 class="text-title mt-4 pb-4">Formulario de sala</h1>

<form action="#">
    <div class="form-group float-input">
        <input type="text" id="name-input" class="form-control" required autofocus>
        <label for="#name-input">Nombre</label>
    </div>
    
    <div class="form-group float-input">
        <textarea name="description" id="description-input" rows="2" class="form-control" required></textarea>
        <label for="#description-input">Descripción</label>
    </div>
    
    <div class="form-group float-input">
        <input type="text" id="limit-input" class="form-control" required autofocus>
        <label for="#limit-input">Limite de usuarios (2+)</label>
    </div>

    <div class="form-group d-flex align-items-center">
        <input type="checkbox" name="remember_account" id="input-remember">
        <label for="input-remember" class="m-0 mr-2">¿Activar al crear?</label>
    </div>
    
    <div class="d-flex align-items-center">
        <a class="btn btn-gray mr-2" type="submit" href="./rooms-index.html">Regresar al listado</a>
        <button class="btn btn-primary" type="submit">Guardar</button>
    </div>
</form>
@endsection
