@extends('layouts.app')

@section('title', 'Nueva tarea')

@section('content')
<div class="page-heading mb-4">
    <p class="eyebrow mb-1">Seguimiento</p>
    <h1 class="fw-bold">Crear tarea</h1>
    <p class="text-secondary">Asigna trabajo únicamente a integrantes del proyecto.</p>
</div>
<div class="card form-card border-0 shadow-sm"><div class="card-body p-4">
    <form method="POST" action="{{ route('projects.tasks.store', $project) }}" novalidate>
        @csrf
        @include('tasks._form')
    </form>
</div></div>
@endsection
