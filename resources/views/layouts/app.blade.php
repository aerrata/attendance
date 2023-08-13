<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body id="app" class="d-flex flex-column">
    <div class="page">
        <div class="container container-narrow py-4">
            <div class="btn-list justify-content-center mb-4">
                @auth
                <a href="{{ route('home') }}" class="btn btn-sm">Home</a>
                <a href="{{ route('generate') }}" class="btn btn-sm">Generate</a>
                <a href="{{ route('scan') }}" class="btn btn-sm">Scan</a>
                <a href="#" class="btn btn-sm" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                @else
                <a href="{{ route('login') }}" class="btn btn-sm">{{ __('Login') }}</a>
                @endauth
            </div>
            @yield('content')
        </div>
    </div>
</body>

</html>