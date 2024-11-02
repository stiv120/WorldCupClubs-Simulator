<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Campeonato Mundial</title>
    @routes
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand">Campeonato Mundial</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('team.index') ? 'active' : '' }}" href="{{ route('teams.index') }}">Gestionar Equipos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('player.index') ? 'active' : '' }}" href="{{ route('players.index') }}">Gestionar Jugadores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('imports.index') ? 'active' : '' }}" href="{{ route('imports.index') }}">Importar Equipos y Jugadores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('simulations.index') ? 'active' : '' }}" href="{{ route('simulations.index') }}">Simulación</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="content">
        @yield('content')
    </div>

    <footer class="bg-dark text-white text-center py-3">
        <div class="container">
            <p>&copy; 2024 Campeonato Mundial. Todos los derechos reservados.</p>
        </div>
    </footer>

    @yield('modal')
</body>
</html>
