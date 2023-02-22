@extends('layouts.app')

@section('page', 'Detalles de la sala')

@section('content')
<div class="card details-card my-4 rounded">
    <div class="card-header">
        <h1 class="text-title m-0">Sala | México</h1>
        <p class="m-0">82 usuarios conectados</p>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="details-info">
                    <p><strong>Nombre</strong></p>
                    <p>México</p>
                </div>
                <div class="details-info">
                    <p><strong>Descripción</strong></p>
                    <p>Lorem ipsum dolor sit amet.</p>
                </div>
                <div class="details-info">
                    <p><strong>Limite</strong></p>
                    <p>100</p>
                </div>
                <div class="details-info">
                    <p><strong>Usuarios conectados</strong></p>
                    <span>82</span>
                    <span class="badge badge-warning ml-1">Casi lleno</span>
                </div>
                <div class="details-info">
                    <p><strong>Estado de la sala</strong></p>
                    <span class="badge badge-success">Activo</span>
                </div>
                <div class="details-info">
                    <p><strong>Fecha de registro</strong></p>
                    <p>hace 1 dia</p>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="details-info users-list mt-3 mt-md-0">
                    <p><strong>Listado de usuarios conectados</strong></p>
                    <ol>
                        <li>
                            <span>Mark</span>
                            <a class="text-danger ml-2" href="#" data-toggle="modal" data-target="#removeUser">Expulsar</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="./rooms-index.html" class="btn btn-gray"><i class="ri-arrow-left-s-line mr-2"></i> Regresar al listado de salas</a>
    </div>
</div>

<!-- Modal Remove User From Room -->
<div class="modal fade" id="removeUser" tabindex="-1" role="dialog" aria-labelledby="removeUserLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title" id="removeUserLabel">Expulsar usuario</h5>
            </div>
            <div class="modal-body py-4">
                <p class="m-0">¿Estas seguro de expulsar al usuario <strong>Mark</strong> de esta sala?</p>
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-gray" data-dismiss="modal">No, cancelar</button>
                <button type="button" class="btn btn-danger">Si, expulsar</button>
            </div>
        </div>
    </div>
</div>
@endsection
