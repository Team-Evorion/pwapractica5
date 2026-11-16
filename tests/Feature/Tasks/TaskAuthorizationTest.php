<?php

namespace Tests\Feature\Tasks;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\TaskStatus;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class TaskAuthorizationTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_project_manager_can_manage_tasks_in_their_project(): void
    {
        $manager = User::factory()->projectManager()->create();
        $member = User::factory()->teamMember()->create();
        $project = Project::factory()->for($manager, 'manager')->create();
        $project->members()->attach($member);

        $response = $this->actingAs($manager)->postJson("/api/projects/{$project->id}/tasks", [
            'assigned_to' => $member->id,
            'title' => 'Crear formulario',
            'description' => 'Formulario principal',
        ])->assertCreated()
            ->assertJsonPath('data.status', TaskStatus::Pending->value);

        $taskId = $response->json('data.id');

        $this->actingAs($manager)
            ->patchJson("/api/tasks/{$taskId}", ['title' => 'Crear formulario de acceso'])
            ->assertOk();

        $this->actingAs($manager)
            ->deleteJson("/api/tasks/{$taskId}")
            ->assertNoContent();
    }

    public function test_manager_cannot_manage_tasks_from_another_project(): void
    {
        $manager = User::factory()->projectManager()->create();
        $otherManager = User::factory()->projectManager()->create();
        $member = User::factory()->teamMember()->create();
        $project = Project::factory()->for($otherManager, 'manager')->create();
        $project->members()->attach($member);

        $this->actingAs($manager)
            ->postJson("/api/projects/{$project->id}/tasks", [
                'assigned_to' => $member->id,
                'title' => 'No permitida',
            ])->assertForbidden();
    }

    public function test_member_can_only_view_and_update_status_of_assigned_tasks(): void
    {
        $manager = User::factory()->projectManager()->create();
        $member = User::factory()->teamMember()->create();
        $project = Project::factory()->for($manager, 'manager')->create();
        $project->members()->attach($member);
        $assignedTask = Task::factory()->for($project)->for($member, 'assignee')->create();
        $otherTask = Task::factory()->for($project)->create();

        $this->actingAs($member)
            ->getJson("/api/projects/{$project->id}/tasks")
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.id', $assignedTask->id);

        $this->actingAs($member)
            ->patchJson("/api/tasks/{$assignedTask->id}/status", [
                'status' => TaskStatus::InProgress->value,
            ])->assertOk()
            ->assertJsonPath('data.status', TaskStatus::InProgress->value);

        $this->actingAs($member)
            ->patchJson("/api/tasks/{$assignedTask->id}", ['title' => 'No permitido'])
            ->assertForbidden();

        $this->actingAs($member)
            ->getJson("/api/tasks/{$otherTask->id}")
            ->assertForbidden();
    }

    public function test_administrator_can_supervise_but_not_modify_tasks(): void
    {
        $administrator = User::factory()->administrator()->create();
        $task = Task::factory()->create();

        $this->actingAs($administrator)
            ->getJson('/api/tasks')
            ->assertOk()
            ->assertJsonPath('data.0.id', $task->id);

        $this->actingAs($administrator)
            ->getJson("/api/tasks/{$task->id}")
            ->assertOk();

        $this->actingAs($administrator)
            ->patchJson("/api/tasks/{$task->id}", ['title' => 'No permitido'])
            ->assertForbidden();
    }
}
