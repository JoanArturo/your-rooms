@extends('layouts.app')

@section('page', 'Desactivar cuenta')

@section('content')
<div class="top-separate">
    <h1 class="text-title text-center m-0 pb-4 mb-2">Desactivar cuenta</h1>
    <div class="container-sm container-center">
        <p class="text-center pb-4 mb-2">
            Al desactivar la cuenta perderás tu información de perfil y  todos los mensajes 
            que has enviado en cada una de las salas.
        </p>
        <div class="d-flex align-items-center justify-content-between">
            <button class="btn btn-block btn-primary" type="button">Ok, desactívalo</button>
            <a class="btn btn-block btn-gray m-0 ml-2" href="#">Cancelar</a>
        </div>
    </div>
</div>
@endsection
