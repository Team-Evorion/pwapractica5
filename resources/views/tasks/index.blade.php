@extends('layouts.app')

@section('title', 'Tareas')

@section('content')
<div class="page-heading mb-4">
    <p class="eyebrow mb-1">Seguimiento</p>
    <h1 class="fw-bold mb-1">Tareas</h1>
    <p class="text-secondary mb-0">El listado está filtrado automáticamente según tu rol y proyectos.</p>
</div>

<div class="card border-0 shadow-sm mb-4"><div class="card-body">
    <form class="row g-2" method="GET" action="{{ route('tasks.index') }}">
        <div class="col-lg-6"><input class="form-control" type="search" name="search" value="{{ $search }}" placeholder="Buscar tarea o proyecto"></div>
        <div class="col-sm-7 col-lg-4">
            <select class="form-select" name="status">
                <option value="">Todos los estados</option>
                @foreach($statuses as $availableStatus)
                    <option value="{{ $availableStatus->value }}" @selected($status === $availableStatus->value)>{{ $availableStatus->value }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-5 col-lg-2 d-grid"><button class="btn btn-outline-primary" type="submit">Filtrar</button></div>
    </form>
</div></div>

@if($tasks->isEmpty())
    <x-empty-state title="No encontramos tareas" message="Prueba otro filtro o espera a que se asignen tareas a tu cuenta." />
@else
    <div class="row g-3">
        @foreach($tasks as $task)
            <div class="col-md-6 col-xl-4">
                <article class="card task-card h-100 border-0 shadow-sm">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start gap-3 mb-3">
                            <span class="small text-primary fw-semibold">{{ $task->project->name }}</span>
                            <x-status-badge :status="$task->status" />
                        </div>
                        <h2 class="h5 fw-bold">{{ $task->title }}</h2>
                        <p class="text-secondary flex-grow-1">{{ str($task->description ?: 'Sin descripción.')->limit(120) }}</p>
                        <div class="small mb-3"><span class="text-secondary">Asignada a</span><br><strong>{{ $task->assignee->name }}</strong></div>
                        <a class="btn btn-outline-primary w-100" href="{{ route('tasks.show', $task) }}">Ver detalles</a>
                    </div>
                </article>
            </div>
        @endforeach
    </div>
    <div class="mt-4">{{ $tasks->links() }}</div>
@endif
@endsection
