<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Project;
use App\Models\Task;
use App\RoleName;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    public function all(Request $request): AnonymousResourceCollection
    {
        Gate::authorize('viewAny', Task::class);

        $user = $request->user()->loadMissing('role');
        $tasks = Task::query()
            ->with(['project', 'assignee.role'])
            ->when(
                $user->hasRole(RoleName::ProjectManager),
                fn (Builder $query) => $query->whereHas(
                    'project',
                    fn (Builder $projectQuery) => $projectQuery->where('manager_id', $user->id),
                ),
            )
            ->when(
                $user->hasRole(RoleName::TeamMember),
                fn (Builder $query) => $query->where('assigned_to', $user->id),
            )
            ->latest('id')
            ->paginate(15);

        return TaskResource::collection($tasks);
    }

    public function index(Request $request, Project $project): AnonymousResourceCollection
    {
        Gate::authorize('view', $project);

        $user = $request->user()->loadMissing('role');
        $tasks = $project->tasks()
            ->with('assignee.role')
            ->when($user->hasRole(RoleName::TeamMember), fn (Builder $query) => $query->where('assigned_to', $user->id))
            ->latest('id')
            ->paginate(15);

        return TaskResource::collection($tasks);
    }

    public function store(StoreTaskRequest $request, Project $project): JsonResponse
    {
        $task = $project->tasks()->create($request->validated());

        return (new TaskResource($task->load('assignee.role')))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Task $task): TaskResource
    {
        Gate::authorize('view', $task);

        return new TaskResource($task->load('assignee.role'));
    }

    public function update(UpdateTaskRequest $request, Task $task): TaskResource
    {
        $task->update($request->validated());

        return new TaskResource($task->refresh()->load('assignee.role'));
    }

    public function destroy(Task $task): Response
    {
        Gate::authorize('delete', $task);
        $task->delete();

        return response()->noContent();
    }
}
