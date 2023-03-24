<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | @yield('page') </title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('libs/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <header>
        @include('layouts.partials._navbar')       
    </header>

    <main class="container px-3 px-lg-0">
        @section('alerts')
            @include('layouts.partials._messages-status')
        @show

        @yield('content')

        @include('layouts.partials._sidebar-rooms')
        @include('layouts.partials._sidebar-chats')

        <div id="modal-container"></div>
    </main>
    
    @yield('js')
</body>
</html>