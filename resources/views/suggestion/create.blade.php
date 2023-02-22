@extends('layouts.app')

@section('page', 'Sugerencia')

@section('content')
<div class="top-separate">
    <h1 class="text-title text-center m-0 pb-4 mb-2">Sugerencias</h1>
    <div class="container-sm container-center">
        <p class="text-center pb-4 mb-2">
            Hola <strong>User</strong> te invitamos a que nos sugieras algún cambio  o alguna funcionalidad que te gustaría que implementáramos dentro del sistema, siéntete libre de comentarnos tus ideas estaremos encantados de leerte.
        </p>
        <form action="#">
            <div class="form-group float-input">
                <textarea name="suggestion" id="suggestion-input" rows="3" class="form-control" required></textarea>
                <label for="#suggestion-input">Mensaje</label>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <button class="btn btn-block btn-primary" type="submit">Enviar</button>
                <a class="btn btn-block btn-gray m-0 ml-2" href="#">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
