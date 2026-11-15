@extends('layouts.app')

@section('title', 'Editar tarea')

@section('content')
<div class="page-heading mb-4">
    <p class="eyebrow mb-1">Seguimiento</p>
    <h1 class="fw-bold">Editar tarea</h1>
    <p class="text-secondary">Actualiza la descripción o cambia el responsable.</p>
</div>
<div class="card form-card border-0 shadow-sm"><div class="card-body p-4">
    <form method="POST" action="{{ route('tasks.update', $task) }}" novalidate>
        @csrf @method('PUT')
        @include('tasks._form')
    </form>
</div></div>
@endsection
