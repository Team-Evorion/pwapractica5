<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Project;
use App\Models\Task;
use App\RoleName;
use App\TaskStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index(Request $request): View
    {
        Gate::authorize('viewAny', Task::class);

        $user = $request->user()->loadMissing('role');
        $status = $request->string('status')->toString();
        $search = $request->string('search')->trim()->toString();

        $tasks = Task::query()
            ->with(['project.manager', 'assignee.role'])
            ->when($user->hasRole(RoleName::ProjectManager), fn (Builder $query) => $query->whereHas('project', fn (Builder $projectQuery) => $projectQuery->where('manager_id', $user->id)))
            ->when($user->hasRole(RoleName::TeamMember), fn (Builder $query) => $query->where('assigned_to', $user->id))
            ->when(in_array($status, TaskStatus::values(), true), fn (Builder $query) => $query->where('status', $status))
            ->when($search !== '', fn (Builder $query) => $query->where(function (Builder $searchQuery) use ($search): void {
                $searchQuery->where('title', 'like', "%{$search}%")
                    ->orWhereHas('project', fn (Builder $projectQuery) => $projectQuery->where('name', 'like', "%{$search}%"));
            }))
            ->latest('id')
            ->paginate(12)
            ->withQueryString();

        $statuses = TaskStatus::cases();

        return view('tasks.index', compact('tasks', 'statuses', 'status', 'search', 'user'));
    }

    public function create(Project $project): View
    {
        Gate::authorize('create', [Task::class, $project]);

        $project->load(['members' => fn ($query) => $query->orderBy('name')]);

        return view('tasks.create', compact('project'));
    }

    public function store(StoreTaskRequest $request, Project $project): RedirectResponse
    {
        $project->tasks()->create($request->validated());

        return redirect()->route('projects.show', $project)->with('success', 'Tarea creada correctamente.');
    }

    public function show(Task $task): View
    {
        Gate::authorize('view', $task);
        $task->load(['project.manager', 'assignee.role']);

        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task): View
    {
        Gate::authorize('update', $task);
        $task->load(['project.members' => fn ($query) => $query->orderBy('name')]);

        return view('tasks.edit', compact('task'));
    }

    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        $task->update($request->validated());

        return redirect()->route('tasks.show', $task)->with('success', 'Tarea actualizada correctamente.');
    }

    public function destroy(Task $task): RedirectResponse
    {
        Gate::authorize('delete', $task);
        $project = $task->project;
        $task->delete();

        return redirect()->route('projects.show', $project)->with('success', 'Tarea eliminada correctamente.');
    }
}
