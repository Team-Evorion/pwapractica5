@extends('layouts.app')

@section('title', $task->title)

@section('content')
<div class="page-heading d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-4">
    <div>
        <p class="eyebrow mb-1">{{ $task->project->name }}</p>
        <h1 class="fw-bold mb-2">{{ $task->title }}</h1>
        <x-status-badge :status="$task->status" class="fs-6" />
    </div>
    <div class="d-flex gap-2">
        <a class="btn btn-light" href="{{ route('projects.show', $task->project) }}">Volver al proyecto</a>
        @can('update', $task)<a class="btn btn-primary" href="{{ route('tasks.edit', $task) }}">Editar tarea</a>@endcan
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm h-100"><div class="card-body p-4 p-lg-5">
            <h2 class="h5">Descripción</h2>
            <p class="task-description mb-0">{{ $task->description ?: 'Esta tarea no tiene una descripción adicional.' }}</p>
        </div></div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm"><div class="card-body p-4">
            <h2 class="h5">Detalles</h2>
            <dl class="task-details mb-0">
                <dt>Responsable</dt><dd>{{ $task->assignee->name }}</dd>
                <dt>Correo</dt><dd>{{ $task->assignee->email }}</dd>
                <dt>Creada</dt><dd>{{ $task->created_at->format('d/m/Y H:i') }}</dd>
                <dt>Actualizada</dt><dd>{{ $task->updated_at->format('d/m/Y H:i') }}</dd>
            </dl>
        </div></div>

        @can('updateStatus', $task)
            <div class="card border-0 shadow-sm mt-4"><div class="card-body p-4">
                <h2 class="h5">Cambiar estado</h2>
                <form method="POST" action="{{ route('tasks.status.update', $task) }}">
                    @csrf @method('PATCH')
                    <select class="form-select mb-3 @error('status') is-invalid @enderror" name="status" required>
                        @foreach(\App\TaskStatus::cases() as $status)
                            <option value="{{ $status->value }}" @selected($task->status === $status)>{{ $status->value }}</option>
                        @endforeach
                    </select>
                    @error('status')<div class="invalid-feedback d-block mb-2">{{ $message }}</div>@enderror
                    <button class="btn btn-primary w-100" type="submit">Actualizar estado</button>
                </form>
            </div></div>
        @endcan
    </div>
</div>

@can('delete', $task)
    <div class="danger-zone d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mt-4">
        <div><strong>Eliminar tarea</strong><p class="mb-0 text-secondary small">Esta acción no puede deshacerse.</p></div>
        <form method="POST" action="{{ route('tasks.destroy', $task) }}" data-confirm="¿Eliminar definitivamente esta tarea?">
            @csrf @method('DELETE')
            <button class="btn btn-outline-danger" type="submit">Eliminar tarea</button>
        </form>
    </div>
@endcan
@endsection
