@extends('layouts.app')

@section('title', $project->name)

@section('content')
<div class="page-heading d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-3 mb-4">
    <div>
        <p class="eyebrow mb-1">Proyecto</p>
        <h1 class="fw-bold mb-2">{{ $project->name }}</h1>
        <p class="text-secondary mb-0">{{ $project->description ?: 'Sin descripción.' }}</p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        @can('update', $project)<a class="btn btn-outline-primary" href="{{ route('projects.edit', $project) }}">Editar proyecto</a>@endcan
        @can('create', [\App\Models\Task::class, $project])<a class="btn btn-primary" href="{{ route('projects.tasks.create', $project) }}">Nueva tarea</a>@endcan
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100"><div class="card-body p-4">
            <h2 class="h5">Responsable</h2>
            <p class="fw-semibold mb-0">{{ $project->manager->name }}</p>
            <p class="text-secondary small">{{ $project->manager->email }}</p>
            <hr>
            <h2 class="h5">Equipo</h2>
            <div class="vstack gap-2">
                @forelse($project->members as $member)
                    <div class="team-person"><span>{{ str($member->name)->substr(0, 1)->upper() }}</span><div><strong>{{ $member->name }}</strong><small>{{ $member->email }}</small></div></div>
                @empty
                    <p class="text-secondary mb-0">No hay miembros asignados.</p>
                @endforelse
            </div>
        </div></div>
    </div>
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3"><h2 class="h5 mb-0">Tareas del proyecto</h2></div>
            @if($project->tasks->isEmpty())
                <x-empty-state class="m-4" title="Sin tareas" message="El gerente puede crear la primera tarea de este proyecto." />
            @else
                <div class="list-group list-group-flush">
                    @foreach($project->tasks as $task)
                        <a class="list-group-item list-group-item-action p-3" href="{{ route('tasks.show', $task) }}">
                            <div class="d-flex justify-content-between gap-3">
                                <div><h3 class="h6 mb-1">{{ $task->title }}</h3><small class="text-secondary">{{ $task->assignee->name }}</small></div>
                                <x-status-badge :status="$task->status" />
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

@can('delete', $project)
    <div class="danger-zone d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
        <div><strong>Eliminar proyecto</strong><p class="mb-0 text-secondary small">También se eliminarán todas sus tareas.</p></div>
        <form method="POST" action="{{ route('projects.destroy', $project) }}" data-confirm="¿Eliminar definitivamente este proyecto y todas sus tareas?">
            @csrf @method('DELETE')
            <button class="btn btn-outline-danger" type="submit">Eliminar proyecto</button>
        </form>
    </div>
@endcan
@endsection
