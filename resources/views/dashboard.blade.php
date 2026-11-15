@extends('layouts.app')

@section('title', 'Resumen')

@section('content')
<div class="page-heading d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-4">
    <div>
        <p class="eyebrow mb-1">Panel {{ $user->role?->name }}</p>
        <h1 class="display-6 fw-bold mb-1">Hola, {{ str($user->name)->before(' ') }}</h1>
        <p class="text-secondary mb-0">Este es el estado actual del trabajo que puedes consultar.</p>
    </div>
    <a class="btn btn-primary" href="{{ route('tasks.index') }}">Ver todas las tareas</a>
</div>

<div class="row g-3 mb-5">
    @if(isset($statistics['users']))
        <div class="col-6 col-xl"><div class="stat-card"><span>Usuarios</span><strong>{{ $statistics['users'] }}</strong></div></div>
    @endif
    <div class="col-6 col-xl"><div class="stat-card"><span>Proyectos</span><strong>{{ $statistics['projects'] }}</strong></div></div>
    <div class="col-6 col-xl"><div class="stat-card"><span>Tareas</span><strong>{{ $statistics['tasks'] }}</strong></div></div>
    <div class="col-6 col-xl"><div class="stat-card stat-card-warning"><span>Pendientes</span><strong>{{ $statistics['pending'] }}</strong></div></div>
    <div class="col-6 col-xl"><div class="stat-card stat-card-success"><span>Completadas</span><strong>{{ $statistics['completed'] }}</strong></div></div>
</div>

<section class="card border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <div><h2 class="h5 mb-1">Actividad reciente</h2><small class="text-secondary">Últimas tareas visibles para tu rol</small></div>
        <a class="btn btn-sm btn-outline-primary" href="{{ route('projects.index') }}">Explorar proyectos</a>
    </div>
    @if($recentTasks->isEmpty())
        <x-empty-state class="m-4" title="Todavía no hay tareas" message="Cuando se asignen tareas aparecerán en este panel." />
    @else
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead><tr><th>Tarea</th><th>Proyecto</th><th>Responsable</th><th>Estado</th><th></th></tr></thead>
                <tbody>
                @foreach($recentTasks as $task)
                    <tr>
                        <td class="fw-semibold">{{ $task->title }}</td>
                        <td>{{ $task->project->name }}</td>
                        <td>{{ $task->assignee->name }}</td>
                        <td><x-status-badge :status="$task->status" /></td>
                        <td class="text-end"><a class="btn btn-sm btn-light" href="{{ route('tasks.show', $task) }}">Abrir</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
</section>
@endsection
