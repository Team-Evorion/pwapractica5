@extends('layouts.app')

@section('title', 'Editar usuario')

@section('content')
<div class="page-heading mb-4">
    <p class="eyebrow mb-1">Administración</p>
    <h1 class="fw-bold">Editar usuario</h1>
    <p class="text-secondary">Actualiza los datos y el rol de {{ $user->name }}.</p>
</div>
<div class="card form-card border-0 shadow-sm"><div class="card-body p-4">
    <form method="POST" action="{{ route('users.update', $user) }}" novalidate>
        @csrf @method('PUT')
        @include('users._form')
    </form>
</div></div>
@endsection
