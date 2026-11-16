@extends('layouts.app')

@section('title', 'Nuevo proyecto')

@section('content')
<div class="page-heading mb-4">
    <p class="eyebrow mb-1">Organización</p>
    <h1 class="fw-bold">Crear proyecto</h1>
    <p class="text-secondary">Define el gerente y las personas que formarán el equipo.</p>
</div>
<div class="card form-card border-0 shadow-sm"><div class="card-body p-4">
    <form method="POST" action="{{ route('projects.store') }}" novalidate>
        @csrf
        @include('projects._form')
    </form>
</div></div>
@endsection
