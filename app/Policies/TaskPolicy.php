<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\RoleName;

class TaskPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Task $task): bool
    {
        if ($user->hasRole(RoleName::Administrator)) {
            return true;
        }

        if ($user->hasRole(RoleName::ProjectManager)) {
            return $task->project->manager_id === $user->id;
        }

        return $user->hasRole(RoleName::TeamMember) && $task->assigned_to === $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Project $project): bool
    {
        return $user->hasRole(RoleName::ProjectManager)
            && $project->manager_id === $user->id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Task $task): bool
    {
        return $user->hasRole(RoleName::ProjectManager)
            && $task->project->manager_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Task $task): bool
    {
        return $user->hasRole(RoleName::ProjectManager)
            && $task->project->manager_id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Task $task): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Task $task): bool
    {
        return false;
    }

    public function updateStatus(User $user, Task $task): bool
    {
        return ($user->hasRole(RoleName::TeamMember) && $task->assigned_to === $user->id)
            || ($user->hasRole(RoleName::ProjectManager) && $task->project->manager_id === $user->id);
    }
}
