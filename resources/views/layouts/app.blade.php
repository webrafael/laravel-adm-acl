<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.ts'])
</head>
<body>
    <main role="main">
        <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-secondary" style="width: 280px;">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <span class="bi-bootstrap h4 mb-0 me-3"></span>
                <span class="fs-4">Administrador</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ Route::is('dashboard') ? 'active bg-dark' : 'text-white' }}" aria-current="page">
                        <span class="bi-house-door"></span>
                        Dashboard
                    </a>
                </li>
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                    id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <strong><i class="bi bi-gear"></i> Configurações</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item" href="{{ route('users.index') }}">Usuários</a></li>
                @if (auth()->user()->isSuperUser())
                    <li><a class="dropdown-item" href="{{ route('roles.index') }}">Cargos</a></li>
                @endif
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('auth.logout') }}"
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Container -->
        <div class="container-fluid">
            <div class="row">
                <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm mb-5 py-3">
                    <div class="container">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav me-auto">

                            </ul>

                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ms-auto">
                                <!-- Authentication Links -->
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('auth.logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>

            <div class="container">
                @include('admin.includes.alerts')

                @yield('content')
            </div>
        </div>

    </main>
</body>
</html>
