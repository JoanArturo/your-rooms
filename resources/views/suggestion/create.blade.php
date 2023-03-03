@extends('layouts.app')

@section('page', 'Sugerencia')

@section('content')
<div class="top-separate">
    <h1 class="text-title text-center m-0 pb-4 mb-2">Sugerencias</h1>
    <div class="container-sm container-center">
        <p class="text-center pb-4 mb-2">
            {!! 
                __('Hello <strong>:name</strong>, we invite you to suggest any change or functionality that you would like us to implement within the system, feel free to tell us your ideas, we will be happy to hear from you.', [
                    'name' => Auth::user()->name
                ])
            !!}
        </p>
        {!! Form::open(['url' => route('suggestion.store')]) !!}

            <div class="form-group float-input">
                {!! Form::textarea('body', null, ['id' => 'suggestion-input', 'class' => 'form-control', 'rows' => 3, 'required' => true]) !!}
                {!! Form::label('suggestion-inpu', 'Mensaje') !!}
            </div>

            <div class="d-flex align-items-center justify-content-between">
                {!! Form::submit(__('Send'), ['class' => 'btn btn-block btn-primary']) !!}
                <a class="btn btn-block btn-gray m-0 ml-2" href="#">{{ __('Cancel') }}</a>
            </div>

        {!! Form::close() !!}
    </div>
</div>
@endsection
