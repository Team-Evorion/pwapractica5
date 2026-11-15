<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Panel') · PWA Práctica 5</title>
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
@php($currentUser = auth()->user()?->loadMissing('role'))
<nav class="navbar navbar-expand-lg navbar-dark app-navbar sticky-top">
    <div class="container-fluid px-3 px-lg-4">
        <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
            <span class="brand-mark">P5</span> Gestión de Tareas
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavigation" aria-controls="mainNavigation" aria-expanded="false" aria-label="Abrir navegación">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNavigation">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4 gap-lg-1">
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Resumen</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('projects.*') ? 'active' : '' }}" href="{{ route('projects.index') }}">Proyectos</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('tasks.*') ? 'active' : '' }}" href="{{ route('tasks.index') }}">Tareas</a></li>
                @if($currentUser?->hasRole(\App\RoleName::Administrator))
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">Usuarios</a></li>
                @endif
            </ul>
            <div class="d-lg-flex align-items-center gap-3 text-white">
                <div class="user-summary my-3 my-lg-0">
                    <span class="d-block fw-semibold">{{ $currentUser?->name }}</span>
                    <small>{{ $currentUser?->role?->name }}</small>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-outline-light btn-sm" type="submit">Cerrar sesión</button>
                </form>
            </div>
        </div>
    </div>
</nav>

<main class="container py-4 py-lg-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    @yield('content')
</main>

<footer class="container pb-4 text-center text-secondary small">
    Clase Práctica 5 · Programación Web Avanzada · UBE
</footer>

<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>
