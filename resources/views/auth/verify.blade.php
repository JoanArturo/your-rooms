@extends('layouts.app')

@section('page', 'Verificación de correo')

@section('content')
<section class="verify-account-container">
    @if (session('resent'))
        <div class="alert alert-success" role="alert">Se ha enviado un nuevo enlace de verificación a su dirección de correo electrónico.</div>
    @endif

    <img src="{{ asset('icons/check.svg') }}" alt="Check icon">
    <h1>Cuenta creada con éxito!</h1>
    <p>Hemos enviado un correo de verificación a <strong class="color-tertiary">{{ Auth::user()->email }}</strong> para comprobar que este correo te pertenece.</p>

    <p>Si no recibiste el correo electrónico, 
        <a href="{{ route('verification.resend') }}" 
            onclick="event.preventDefault();
                        document.getElementById('resend-form').submit();">
            haga clic aquí para solicitar otro
        </a>.
    </p>

    <form method="POST" action="{{ route('verification.resend') }}" id="resend-form" style="display: none;">
        @csrf
    </form>
</section>
@endsection
