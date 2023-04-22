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

            <a href="{{ url('auth/google') }}" class="btn d-flex btn-light align-items-center border text-dark font-weight-bold mb-4">
                <i class="ri-google-line mr-2"></i> {{ __('Login With Google') }}
            </a>

            <span class="separator-or">{{ __('Or') }}</span>
            
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
                    <label for="email-input">{{ __('validation.attributes.email') }}</label>
                </div>
                <div class="form-group float-input">
                    <input type="password" id="password-input" class="form-control" name="password" required autocomplete="current-password">
                    <label for="password-input">{{ __('validation.attributes.password') }}</label>
                </div>
                <div class="form-group d-flex align-items-center">
                    <input type="checkbox" name="remember" id="input-remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="input-remember" class="m-0 mr-2">{{ __('Remember this account?') }}</label>
                </div>
                <button class="btn btn-block btn-primary font-weight-bold" type="submit">{{ __('Login') }}</button>
            </form>
            <p class="m-0 pt-5 mb-3 text-center">{{ __("Don't you have an account?") }} <a href="#register" id="btn-go-register"><strong class="text-primary">{{ __('Sign up here') }}</strong></a></p>

            {{-- <a href="{{ url('auth/google') }}" class="btn d-flex align-items-center btn-light border text-dark font-weight-bold mt-5 mb-3">
                <i class="ri-google-line mr-2"></i> {{ __('Login With Google') }}
            </a> --}}
        </div>
        
        {{-- Register Form --}}
        <div class="form-container" style="display: none; left: 120%; opacity: 0;" id="register-form">
            <h1 class="text-title text-center m-0 pt-3 pb-5">{{ __('Create an account') }}</h1>
            
            <div class="errors-container"></div>
            
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group float-input">
                    <input type="text" id="name-input" class="form-control" name="name" required autocomplete="name">
                    <label for="name-input">{{ __('validation.attributes.name') }}</label>
                </div>
                <div class="form-group float-input">
                    <input type="text" id="email-input" class="form-control" name="email" required autocomplete="email">
                    <label for="email-input">{{ __('validation.attributes.email') }}</label>
                </div>
                <div class="form-group float-input">
                    <input type="password" id="password-input" class="form-control" name="password" required autocomplete="new-password">
                    <label for="password-input">{{ __('validation.attributes.password') }}</label>
                </div>
                <div class="form-group float-input">
                    <input type="password" id="password-confirmation-input" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    <label for="password-confirmation-input">{{ __('validation.attributes.repeat_password') }}</label>
                </div>
                <button class="btn btn-block btn-primary font-weight-bold" id="btn-create-account" type="submit">{{ __('Create now!') }}</button>
            </form>
            <p class="m-0 pt-5 pb-3 text-center">{{ __('Do you already have an account?') }} <a href="#login" id="btn-go-login"><strong class="text-primary">{{ __('Login') }}</strong></a></p>
        </div>
    </main>
</body>
</html>