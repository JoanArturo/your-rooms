<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <main class="login-container">
        {{-- Login Form --}}
        <div class="form-container" id="login-form">
            <h1 class="text-title text-center m-0 pt-3 pb-5">{{ config('app.name', 'Laravel') }}</h1>
            
            @if ($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul class="m-0 p-0">
                        @foreach ($errors->all() as $error)
                            <li class="ml-2">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group float-input">
                    <input type="text" id="email-input" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                    <label for="#email-input">E-mail</label>
                </div>
                <div class="form-group float-input">
                    <input type="password" id="password-input" class="form-control" name="password" required autocomplete="current-password">
                    <label for="#password-input">Contraseña</label>
                </div>
                <div class="form-group d-flex align-items-center">
                    <input type="checkbox" name="remember" id="input-remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="input-remember" class="m-0 mr-2">Recordar esta cuenta?</label>
                </div>
                <button class="btn btn-block btn-primary text-uppercase" type="submit">Iniciar sesión</button>
            </form>
            <p class="m-0 pt-5 pb-3 text-center">No tienes una cuenta? <a href="#register" id="btn-go-register"><strong class="text-primary">Regístrate aquí</strong></a></p>
        </div>
        
        {{-- Register Form --}}
        <div class="form-container" style="display: none; left: 120%; opacity: 0;" id="register-form">
            <h1 class="text-title text-center m-0 pt-3 pb-5">Crear una cuenta</h1>
            
            <div class="errors-container"></div>
            
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group float-input">
                    <input type="text" id="username-input" class="form-control" name="name" required autocomplete="name">
                    <label for="#username-input">Username</label>
                </div>
                <div class="form-group float-input">
                    <input type="text" id="email-input" class="form-control" name="email" required autocomplete="email">
                    <label for="#email-input">E-mail</label>
                </div>
                <div class="form-group float-input">
                    <input type="password" id="password-input" class="form-control" name="password" required autocomplete="new-password">
                    <label for="#password-input">Contraseña</label>
                </div>
                <div class="form-group float-input">
                    <input type="password" id="password-confirmation-input" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    <label for="#password-confirmation-input">Repetir contraseña</label>
                </div>
                <button class="btn btn-block btn-primary text-uppercase" id="btn-create-account" type="submit">Crear ahora!</button>
            </form>
            <p class="m-0 pt-5 pb-3 text-center">Ya tienes una cuenta? <a href="#login" id="btn-go-login"><strong class="text-primary">Iniciar sesión</strong></a></p>
        </div>
    </main>
</body>
</html>