@php
    $editing = isset($task);
    $currentProject = $editing ? $task->project : $project;
@endphp
<div class="alert alert-light border mb-4">
    <span class="text-secondary small">Proyecto</span><br>
    <strong>{{ $currentProject->name }}</strong>
</div>
<div class="row g-3">
    <div class="col-md-7">
        <label class="form-label" for="title">Título</label>
        <input class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $task->title ?? '') }}" required maxlength="50">
        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-5">
        <label class="form-label" for="assigned_to">Responsable</label>
        <select class="form-select @error('assigned_to') is-invalid @enderror" id="assigned_to" name="assigned_to" required>
            <option value="">Selecciona un miembro</option>
            @foreach($currentProject->members as $member)
                <option value="{{ $member->id }}" @selected((string) old('assigned_to', $task->assigned_to ?? '') === (string) $member->id)>{{ $member->name }}</option>
            @endforeach
        </select>
        @error('assigned_to')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12">
        <label class="form-label" for="description">Descripción</label>
        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" maxlength="300">{{ old('description', $task->description ?? '') }}</textarea>
        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
        <div class="form-text">Máximo 300 caracteres.</div>
    </div>
</div>

<div class="d-flex flex-column flex-sm-row gap-2 justify-content-end mt-4">
    <a class="btn btn-light" href="{{ $editing ? route('tasks.show', $task) : route('projects.show', $currentProject) }}">Cancelar</a>
    <button class="btn btn-primary" type="submit">{{ $editing ? 'Guardar cambios' : 'Crear tarea' }}</button>
</div>
