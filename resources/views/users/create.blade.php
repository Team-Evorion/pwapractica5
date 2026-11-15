@extends('layouts.app')

@section('title', 'Nuevo usuario')

@section('content')
<div class="page-heading mb-4">
    <p class="eyebrow mb-1">Administración</p>
    <h1 class="fw-bold">Crear usuario</h1>
    <p class="text-secondary">Asigna una cuenta y el rol que determinará sus permisos.</p>
</div>
<div class="card form-card border-0 shadow-sm"><div class="card-body p-4">
    <form method="POST" action="{{ route('users.store') }}" novalidate>
        @csrf
        @include('users._form')
    </form>
</div></div>
@endsection
