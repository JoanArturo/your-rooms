@extends('layouts.app')

@section('page', 'Users')

@section('content')
<div class="table-responsive rounded mt-4">
    <div class="table-header-options">
        <h5 class="table-title"><i class="ri-table-line ri-sm"></i> Usuarios</h5>
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
                <th scope="col">Email</th>
                <th scope="col">Rol</th>
                <th scope="col">Estado de la cuenta</th>
                <th scope="col">Fecha de registro</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Admin</td>
                <td>@admin</td>
                <td>Administrador</td>
                <td>
                    <span class="badge badge-success">Activo</span>
                </td>
                <td>hace 2 dias</td>
                <td>
                    <a href="#" class="btn btn-info table-btn"><i class="ri-pencil-line"></i>Editar</a>
                    <button type="button" class="btn btn-danger table-btn" data-toggle="modal" data-target="#deleteRecord"><i class="ri-delete-bin-line"></i> Eliminar</button>
                </td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Mark</td>
                <td>@mdo</td>
                <td>Usuario</td>
                <td>
                    <span class="badge badge-success">Activo</span>
                </td>
                <td>hace 2 dias</td>
                <td>
                    <a href="#" class="btn btn-info table-btn"><i class="ri-pencil-line"></i>Editar</a>
                    <button type="button" class="btn btn-danger table-btn" data-toggle="modal" data-target="#deleteRecord"><i class="ri-delete-bin-line"></i> Eliminar</button>
                </td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Jacob</td>
                <td>@fat</td>
                <td>Usuario</td>
                <td>
                    <span class="badge badge-success">Activo</span>
                </td>
                <td>hace 2 dias</td>
                <td>
                    <a href="#" class="btn btn-info table-btn"><i class="ri-pencil-line"></i>Editar</a>
                    <button type="button" class="btn btn-danger table-btn" data-toggle="modal" data-target="#deleteRecord"><i class="ri-delete-bin-line"></i> Eliminar</button>
                </td>
            </tr>
            <tr>
                <th scope="row">4</th>
                <td>Larry</td>
                <td>@twitter</td>
                <td>Usuario</td>
                <td>
                    <span class="badge badge-danger">Baneado</span>
                </td>
                <td>hace 2 dias</td>
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
                <p class="m-0">¿Estas seguro de eliminar el registro <strong>Mark</strong>?</p>
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-gray" data-dismiss="modal">No, cancelar</button>
                <button type="button" class="btn btn-danger">Si, eliminar</button>
            </div>
        </div>
    </div>
</div>
@endsection
