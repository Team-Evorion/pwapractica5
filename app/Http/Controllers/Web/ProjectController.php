<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\User;
use App\RoleName;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(Request $request): View
    {
        Gate::authorize('viewAny', Project::class);

        $user = $request->user()->loadMissing('role');
        $search = $request->string('search')->trim()->toString();
        $projects = Project::query()
            ->with(['manager.role', 'members.role'])
            ->withCount('tasks')
            ->when($user->hasRole(RoleName::ProjectManager), fn (Builder $query) => $query->where('manager_id', $user->id))
            ->when($user->hasRole(RoleName::TeamMember), fn (Builder $query) => $query->whereHas('members', fn (Builder $memberQuery) => $memberQuery->whereKey($user->id)))
            ->when($search !== '', fn (Builder $query) => $query->where('name', 'like', "%{$search}%"))
            ->latest('id')
            ->paginate(9)
            ->withQueryString();

        return view('projects.index', compact('projects', 'search', 'user'));
    }

    public function create(): View
    {
        Gate::authorize('create', Project::class);

        [$managers, $members] = $this->availablePeople();

        return view('projects.create', compact('managers', 'members'));
    }

    public function store(StoreProjectRequest $request): RedirectResponse
    {
        $project = DB::transaction(function () use ($request): Project {
            $project = Project::query()->create($request->safe()->except('member_ids'));
            $project->members()->sync($request->input('member_ids', []));

            return $project;
        });

        return redirect()->route('projects.show', $project)->with('success', 'Proyecto creado correctamente.');
    }

    public function show(Request $request, Project $project): View
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

        return view('projects.show', compact('project', 'user'));
    }

    public function edit(Project $project): View
    {
        Gate::authorize('update', $project);

        [$managers, $members] = $this->availablePeople();
        $project->load('members');

        return view('projects.edit', compact('project', 'managers', 'members'));
    }

    public function update(UpdateProjectRequest $request, Project $project): RedirectResponse
    {
        DB::transaction(function () use ($request, $project): void {
            $project->update($request->safe()->except('member_ids'));
            $project->members()->sync($request->input('member_ids', []));
        });

        return redirect()->route('projects.show', $project)->with('success', 'Proyecto actualizado correctamente.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        Gate::authorize('delete', $project);
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Proyecto eliminado correctamente.');
    }

    /** @return array{0: Collection<int, User>, 1: Collection<int, User>} */
    private function availablePeople(): array
    {
        $managers = User::query()
            ->whereHas('role', fn (Builder $query) => $query->where('name', RoleName::ProjectManager->value))
            ->orderBy('name')
            ->get();
        $members = User::query()
            ->whereHas('role', fn (Builder $query) => $query->where('name', RoleName::TeamMember->value))
            ->orderBy('name')
            ->get();

        return [$managers, $members];
    }
}
