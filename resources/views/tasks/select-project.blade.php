@extends('layouts.app')

@section('title', 'Nueva tarea')

@section('content')
<div class="page-heading mb-4">
    <p class="eyebrow mb-1">Primer paso</p>
    <h1 class="fw-bold mb-1">¿En qué proyecto crearás la tarea?</h1>
    <p class="text-secondary mb-0">Elige un proyecto para cargar únicamente sus integrantes como responsables.</p>
</div>

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
                    <p class="text-secondary flex-grow-1">{{ str($project->description ?: 'Sin descripción.')->limit(100) }}</p>
                    <div class="small mb-3">
                        <span class="text-secondary">Gerente</span><br>
                        <strong>{{ $project->manager->name }}</strong>
                    </div>
                    <div class="d-flex justify-content-between align-items-center gap-3">
                        <span class="small text-secondary">{{ $project->members->count() }} miembros</span>
                        <a class="btn btn-sm btn-primary" href="{{ route('projects.tasks.create', $project) }}">Elegir proyecto</a>
                    </div>
                </div>
            </article>
        </div>
    @endforeach
</div>
@endsection
