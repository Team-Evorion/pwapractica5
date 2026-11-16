<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\RoleName;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ProjectController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        Gate::authorize('viewAny', Project::class);

        $user = $request->user()->loadMissing('role');
        $projects = Project::query()
            ->with(['manager.role', 'members.role'])
            ->withCount('tasks')
            ->when($user->hasRole(RoleName::ProjectManager), fn (Builder $query) => $query->where('manager_id', $user->id))
            ->when($user->hasRole(RoleName::TeamMember), fn (Builder $query) => $query->whereHas('members', fn (Builder $memberQuery) => $memberQuery->whereKey($user->id)))
            ->latest('id')
            ->paginate(15);

        return ProjectResource::collection($projects);
    }

    public function store(StoreProjectRequest $request): JsonResponse
    {
        $project = DB::transaction(function () use ($request): Project {
            $project = Project::query()->create($request->safe()->except('member_ids'));
            $project->members()->sync($request->input('member_ids', []));

            return $project;
        });

        return (new ProjectResource($project->load(['manager.role', 'members.role'])->loadCount('tasks')))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Request $request, Project $project): ProjectResource
    {
        Gate::authorize('view', $project);

        $user = $request->user()->loadMissing('role');
        $project->load([
            'manager.role',
            'members.role',
            'tasks' => fn (Builder $query) => $query
                ->when($user->hasRole(RoleName::TeamMember), fn (Builder $taskQuery) => $taskQuery->where('assigned_to', $user->id))
                ->with('assignee.role')
                ->latest('id'),
        ]);

        return new ProjectResource($project);
    }

    public function update(UpdateProjectRequest $request, Project $project): ProjectResource
    {
        DB::transaction(function () use ($request, $project): void {
            $project->update($request->safe()->except('member_ids'));

            if ($request->has('member_ids')) {
                $project->members()->sync($request->input('member_ids', []));
            }
        });

        return new ProjectResource($project->refresh()->load(['manager.role', 'members.role'])->loadCount('tasks'));
    }

    public function destroy(Project $project): Response
    {
        Gate::authorize('delete', $project);
        $project->delete();

        return response()->noContent();
    }
}
