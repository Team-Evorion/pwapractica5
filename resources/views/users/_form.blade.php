@php($editing = isset($user))
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="name">Nombre completo</label>
        <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name ?? '') }}" required maxlength="50">
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label" for="email">Correo electrónico</label>
        <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="email" value="{{ old('email', $user->email ?? '') }}" required maxlength="100">
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12">
        <label class="form-label" for="role_id">Rol</label>
        <select class="form-select @error('role_id') is-invalid @enderror" id="role_id" name="role_id" required>
            <option value="">Selecciona un rol</option>
            @foreach($roles as $role)
                <option value="{{ $role->id }}" @selected((string) old('role_id', $user->role_id ?? '') === (string) $role->id)>{{ $role->name }}</option>
            @endforeach
        </select>
        @error('role_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    @unless($editing)
        <div class="col-md-6">
            <label class="form-label" for="password">Contraseña</label>
            <input class="form-control @error('password') is-invalid @enderror" id="password" name="password" type="password" required minlength="8">
            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6">
            <label class="form-label" for="password_confirmation">Confirmar contraseña</label>
            <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" required minlength="8">
        </div>
    @endunless
</div>

<div class="d-flex flex-column flex-sm-row gap-2 justify-content-end mt-4">
    <a class="btn btn-light" href="{{ route('users.index') }}">Cancelar</a>
    <button class="btn btn-primary" type="submit">{{ $editing ? 'Guardar cambios' : 'Crear usuario' }}</button>
</div>
