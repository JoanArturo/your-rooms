@extends('layouts.app')

@section('page', 'Detalles del usuario')

@section('content')
<div class="card details-card my-4 rounded">
    <div class="card-header">
        <div class="details-image">
            <img src="{{ asset('icons/camera.svg') }}" alt="Profile image">
        </div>
        <h1 class="text-title m-0">Mark</h1>
        <p class="m-0">Usuario</p>
    </div>
    <div class="card-body">
        <div class="details-info">
            <p><strong>Nombre</strong></p>
            <p>Mark</p>
        </div>
        <div class="details-info">
            <p><strong>Email</strong></p>
            <p>@mdo</p>
        </div>
        <div class="details-info">
            <p><strong>Rol</strong></p>
            <p>Usuario</p>
        </div>
        <div class="details-info">
            <p><strong>Estado de la cuenta</strong></p>
            <span class="badge badge-success">Activo</span>
        </div>
        <div class="details-info">
            <p><strong>Fecha de registro</strong></p>
            <p>hace 2 dias</p>
        </div>
    </div>
    <div class="card-footer">
        <a href="./users-index.html" class="btn btn-gray"><i class="ri-arrow-left-s-line mr-2"></i> Regresar al listado de usuarios</a>
        <button href="#" class="btn btn-danger"><i class="ri-forbid-line mr-2"></i> Banear cuenta</button>
        <button href="#" class="btn btn-info"><i class="ri-forbid-line mr-2"></i> Desbanear cuenta</button>
    </div>
</div>
@endsection
