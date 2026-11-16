@extends('layouts.guest')

@section('content')
<div class="login-shell row g-0 w-100 overflow-hidden shadow-lg">
    <section class="col-lg-6 login-hero d-none d-lg-flex flex-column justify-content-between p-5 text-white">
        <div>
            <span class="brand-mark brand-mark-lg">P5</span>
            <h1 class="display-5 fw-bold mt-4">Organiza el trabajo. Protege cada permiso.</h1>
            <p class="lead text-white-50">Sistema de gestión de tareas por equipos desarrollado con Laravel, MySQL, Bootstrap 5 y JavaScript.</p>
        </div>
        <div class="small text-white-50">Universidad Bolivariana del Ecuador · Programación Web Avanzada</div>
    </section>
    <section class="col-lg-6 bg-white p-4 p-md-5 d-flex align-items-center">
        <div class="w-100 mx-auto login-form">
            <div class="d-lg-none mb-4"><span class="brand-mark">P5</span></div>
            <p class="text-uppercase text-primary fw-bold small mb-2">Acceso seguro</p>
            <h2 class="fw-bold mb-2">Bienvenido</h2>
            <p class="text-secondary mb-4">Ingresa con la cuenta asignada a tu rol.</p>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('login.store') }}" novalidate>
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="email">Correo electrónico</label>
                    <input class="form-control form-control-lg @error('email') is-invalid @enderror" id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required autofocus>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password">Contraseña</label>
                    <div class="input-group input-group-lg">
                        <input class="form-control @error('password') is-invalid @enderror" id="password" name="password" type="password" autocomplete="current-password" required>
                        <button class="btn btn-outline-secondary password-toggle" type="button" data-password-target="password">Ver</button>
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="form-check mb-4">
                    <input class="form-check-input" id="remember" name="remember" type="checkbox" value="1" @checked(old('remember'))>
                    <label class="form-check-label" for="remember">Mantener la sesión iniciada</label>
                </div>
                <button class="btn btn-primary btn-lg w-100" type="submit">Iniciar sesión</button>
            </form>
        </div>
    </section>
</div>
@endsection
