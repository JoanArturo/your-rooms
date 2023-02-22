@extends('layouts.app')

@section('page', 'Rooms')

@section('content')
<div class="table-responsive rounded mt-4">
    <div class="table-header-options">
        <h5 class="table-title"><i class="ri-table-line ri-sm"></i> Salas</h5>
        <div class="d-flex align-items-center">
            <form action="#" class="position-relative">
                <input type="text" placeholder="Buscar" class="form-control table-search-input">
                <i class="ri-search-line"></i>
            </form>
            <a href="#" class="table-button-add ml-2">
                <i class="ri-add-line"></i> Nuevo
            </a>
        </div>
    </div>
    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col">Limite</th>
                <th scope="col">Usuarios conectados</th>
                <th scope="col">Fecha de registro</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Todo el mundo</td>
                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat, facilis?</td>
                <td>10</td>
                <td>2</td>
                <td>hace 2 dias</td>
                <td>
                    <a href="#" class="btn btn-info table-btn"><i class="ri-pencil-line"></i>Editar</a>
                    <button type="button" class="btn btn-danger table-btn" data-toggle="modal" data-target="#deleteRecord"><i class="ri-delete-bin-line"></i> Eliminar</button>
                </td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>México</td>
                <td>Lorem ipsum dolor sit amet.</td>
                <td>100</td>
                <td>
                    <span>82</span>
                    <span class="badge badge-warning ml-1">Casi lleno</span>
                </td>
                <td>hace 1 dia</td>
                <td>
                    <a href="#" class="btn btn-info table-btn"><i class="ri-pencil-line"></i>Editar</a>
                    <button type="button" class="btn btn-danger table-btn" data-toggle="modal" data-target="#deleteRecord"><i class="ri-delete-bin-line"></i> Eliminar</button>
                </td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Latinos</td>
                <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nulla, odit. Vitae doloribus unde eum.</td>
                <td>300</td>
                <td>
                    <span>300</span>
                    <span class="badge badge-danger ml-1">Lleno</span>
                </td>
                <td>hace 10 dias</td>
                <td>
                    <a href="#" class="btn btn-info table-btn"><i class="ri-pencil-line"></i>Editar</a>
                    <button type="button" class="btn btn-danger table-btn" data-toggle="modal" data-target="#deleteRecord"><i class="ri-delete-bin-line"></i> Eliminar</button>
                </td>
            </tr>
            <tr>
                <th scope="row">4</th>
                <td>España</td>
                <td>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</td>
                <td>250</td>
                <td>102</td>
                <td>hace 1 mes</td>
                <td>
                    <a href="#" class="btn btn-info table-btn"><i class="ri-pencil-line"></i>Editar</a>
                    <button type="button" class="btn btn-danger table-btn" data-toggle="modal" data-target="#deleteRecord"><i class="ri-delete-bin-line"></i> Eliminar</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="deleteRecord" tabindex="-1" role="dialog" aria-labelledby="deleteRecordLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title" id="deleteRecordLabel">Eliminar registro</h5>
            </div>
            <div class="modal-body py-4">
                <p class="m-0">¿Estas seguro de eliminar el registro <strong>México</strong>?</p>
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-gray" data-dismiss="modal">No, cancelar</button>
                <button type="button" class="btn btn-danger">Si, eliminar</button>
            </div>
        </div>
    </div>
</div>
@endsection
