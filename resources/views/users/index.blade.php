@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')
<div class="page-heading d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-4">
    <div>
        <p class="eyebrow mb-1">Administración</p>
        <h1 class="fw-bold mb-1">Usuarios y roles</h1>
        <p class="text-secondary mb-0">Crea cuentas y controla el alcance de cada integrante.</p>
    </div>
    <a class="btn btn-primary" href="{{ route('users.create') }}">Nuevo usuario</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3">
        <form class="row g-2" method="GET" action="{{ route('users.index') }}">
            <div class="col-md-9"><input class="form-control" type="search" name="search" value="{{ $search }}" placeholder="Buscar por nombre o correo"></div>
            <div class="col-md-3 d-grid"><button class="btn btn-outline-primary" type="submit">Buscar</button></div>
        </form>
    </div>
    @if($users->isEmpty())
        <x-empty-state class="m-4" title="No hay usuarios" message="Crea la primera cuenta para comenzar." />
    @else
        <div class="table-responsive">
            <table class="table users-table align-middle mb-0">
                <thead><tr><th>Nombre</th><th>Correo</th><th>Rol</th><th>Registro</th><th class="text-end">Acciones</th></tr></thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td data-label="Nombre" class="fw-semibold">{{ $user->name }}</td>
                        <td data-label="Correo" class="user-email">{{ $user->email }}</td>
                        <td data-label="Rol"><span class="badge text-bg-light border">{{ $user->role?->name }}</span></td>
                        <td data-label="Registro">{{ $user->created_at->format('d/m/Y') }}</td>
                        <td data-label="Acciones" class="text-end">
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('users.edit', $user) }}">Editar</a>
                            @if(! auth()->user()->is($user))
                                <form class="d-inline" method="POST" action="{{ route('users.destroy', $user) }}" data-confirm="¿Eliminar a {{ $user->name }}? Esta acción no se puede deshacer.">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" type="submit">Eliminar</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer bg-white">{{ $users->links() }}</div>
    @endif
</div>
@endsection
