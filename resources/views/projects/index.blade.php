@extends('layouts.app')

@section('title', 'Proyectos')

@section('content')
<div class="page-heading d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-4">
    <div>
        <p class="eyebrow mb-1">Organización</p>
        <h1 class="fw-bold mb-1">Proyectos</h1>
        <p class="text-secondary mb-0">Consulta equipos, responsables y avance de tareas.</p>
    </div>
    @can('create', \App\Models\Project::class)
        <a class="btn btn-primary" href="{{ route('projects.create') }}">Nuevo proyecto</a>
    @endcan
</div>

<form class="row g-2 mb-4" method="GET" action="{{ route('projects.index') }}">
    <div class="col-md-9"><input class="form-control" type="search" name="search" value="{{ $search }}" placeholder="Buscar proyecto"></div>
    <div class="col-md-3 d-grid"><button class="btn btn-outline-primary" type="submit">Buscar</button></div>
</form>

@if($projects->isEmpty())
    <x-empty-state title="No hay proyectos disponibles" message="Los proyectos relacionados con tu cuenta aparecerán aquí.">
        @can('create', \App\Models\Project::class)
            <x-slot:action><a class="btn btn-primary" href="{{ route('projects.create') }}">Crear proyecto</a></x-slot:action>
        @endcan
    </x-empty-state>
@else
    <div class="row g-4">
        @foreach($projects as $project)
            <div class="col-md-6 col-xl-4">
                <article class="card project-card h-100 border-0 shadow-sm">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start gap-3 mb-3">
                            <span class="project-icon">{{ str($project->name)->substr(0, 1)->upper() }}</span>
                            <span class="badge text-bg-light border">{{ $project->tasks_count }} tareas</span>
                        </div>
                        <h2 class="h5 fw-bold">{{ $project->name }}</h2>
                        <p class="text-secondary flex-grow-1">{{ str($project->description ?: 'Sin descripción.')->limit(120) }}</p>
                        <div class="small mb-3">
                            <span class="text-secondary">Gerente</span><br>
                            <strong>{{ $project->manager->name }}</strong>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="small text-secondary">{{ $project->members->count() }} miembros</span>
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('projects.show', $project) }}">Abrir proyecto</a>
                        </div>
                    </div>
                </article>
            </div>
        @endforeach
    </div>
    <div class="mt-4">{{ $projects->links() }}</div>
@endif
@endsection
