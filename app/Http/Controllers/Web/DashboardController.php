<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\RoleName;
use App\TaskStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user = $request->user()->loadMissing('role');
        $taskQuery = Task::query()->with(['project', 'assignee.role']);
        $projectQuery = Project::query();

        if ($user->hasRole(RoleName::ProjectManager)) {
            $taskQuery->whereHas('project', fn (Builder $query) => $query->where('manager_id', $user->id));
            $projectQuery->where('manager_id', $user->id);
        } elseif ($user->hasRole(RoleName::TeamMember)) {
            $taskQuery->where('assigned_to', $user->id);
            $projectQuery->whereHas('members', fn (Builder $query) => $query->whereKey($user->id));
        }

        $statistics = [
            'projects' => (clone $projectQuery)->count(),
            'tasks' => (clone $taskQuery)->count(),
            'pending' => (clone $taskQuery)->where('status', TaskStatus::Pending->value)->count(),
            'completed' => (clone $taskQuery)->where('status', TaskStatus::Completed->value)->count(),
        ];

        if ($user->hasRole(RoleName::Administrator)) {
            $statistics['users'] = User::query()->count();
        }

        $recentTasks = $taskQuery->latest('id')->limit(6)->get();

        return view('dashboard', compact('user', 'statistics', 'recentTasks'));
    }
}
