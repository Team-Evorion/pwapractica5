@php
    $editing = isset($project);
    $selectedMembers = collect(old('member_ids', $editing ? $project->members->pluck('id')->all() : []))->map(fn ($id) => (string) $id);
@endphp
<div class="row g-3">
    <div class="col-md-7">
        <label class="form-label" for="name">Nombre del proyecto</label>
        <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $project->name ?? '') }}" required maxlength="100">
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-5">
        <label class="form-label" for="manager_id">Gerente responsable</label>
        <select class="form-select @error('manager_id') is-invalid @enderror" id="manager_id" name="manager_id" required>
            <option value="">Selecciona un gerente</option>
            @foreach($managers as $manager)
                <option value="{{ $manager->id }}" @selected((string) old('manager_id', $project->manager_id ?? '') === (string) $manager->id)>{{ $manager->name }}</option>
            @endforeach
        </select>
        @error('manager_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12">
        <label class="form-label" for="description">Descripción</label>
        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" maxlength="1000">{{ old('description', $project->description ?? '') }}</textarea>
        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12">
        <fieldset>
            <legend class="form-label">Miembros del equipo</legend>
            @error('member_ids')<div class="text-danger small mb-2">{{ $message }}</div>@enderror
            @error('member_ids.*')<div class="text-danger small mb-2">{{ $message }}</div>@enderror
            <div class="member-grid">
                @forelse($members as $member)
                    <label class="member-option">
                        <input class="form-check-input" type="checkbox" name="member_ids[]" value="{{ $member->id }}" @checked($selectedMembers->contains((string) $member->id))>
                        <span><strong>{{ $member->name }}</strong><small>{{ $member->email }}</small></span>
                    </label>
                @empty
                    <p class="text-secondary mb-0">Primero debes crear usuarios con el rol Miembro del equipo.</p>
                @endforelse
            </div>
        </fieldset>
    </div>
</div>

<div class="d-flex flex-column flex-sm-row gap-2 justify-content-end mt-4">
    <a class="btn btn-light" href="{{ route('projects.index') }}">Cancelar</a>
    <button class="btn btn-primary" type="submit">{{ $editing ? 'Guardar cambios' : 'Crear proyecto' }}</button>
</div>
