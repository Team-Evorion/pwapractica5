@extends('layouts.app')

@section('title', 'Editar proyecto')

@section('content')
<div class="page-heading mb-4">
    <p class="eyebrow mb-1">Organización</p>
    <h1 class="fw-bold">Editar proyecto</h1>
    <p class="text-secondary">Actualiza la información y composición del equipo.</p>
</div>
<div class="card form-card border-0 shadow-sm"><div class="card-body p-4">
    <form method="POST" action="{{ route('projects.update', $project) }}" novalidate>
        @csrf @method('PUT')
        @include('projects._form')
    </form>
</div></div>
@endsection
