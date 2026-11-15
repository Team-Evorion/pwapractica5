<?php

namespace Tests\Feature\Web;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\TaskStatus;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class WebRoleAccessTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_administrator_can_open_user_management(): void
    {
        $administrator = User::factory()->administrator()->create();
        $member = User::factory()->teamMember()->create();

        $this->actingAs($administrator)
            ->get('/users')
            ->assertOk()
            ->assertSee('Usuarios y roles')
            ->assertSee($member->email);
    }

    public function test_non_administrator_cannot_open_user_management(): void
    {
        $member = User::factory()->teamMember()->create();

        $this->actingAs($member)
            ->get('/users')
            ->assertForbidden();
    }

    public function test_manager_can_create_task_only_in_owned_project(): void
    {
        $manager = User::factory()->projectManager()->create();
        $otherManager = User::factory()->projectManager()->create();
        $member = User::factory()->teamMember()->create();
        $project = Project::factory()->for($manager, 'manager')->create();
        $otherProject = Project::factory()->for($otherManager, 'manager')->create();
        $project->members()->attach($member);
        $otherProject->members()->attach($member);

        $this->actingAs($manager)
            ->get("/projects/{$project->id}/tasks/create")
            ->assertOk()
            ->assertSee('Crear tarea');

        $this->actingAs($manager)
            ->get("/projects/{$otherProject->id}/tasks/create")
            ->assertForbidden();
    }

    public function test_member_can_update_only_their_assigned_task_status(): void
    {
        $manager = User::factory()->projectManager()->create();
        $member = User::factory()->teamMember()->create();
        $otherMember = User::factory()->teamMember()->create();
        $project = Project::factory()->for($manager, 'manager')->create();
        $project->members()->attach([$member->id, $otherMember->id]);
        $assignedTask = Task::factory()->for($project)->for($member, 'assignee')->create();
        $otherTask = Task::factory()->for($project)->for($otherMember, 'assignee')->create();

        $this->actingAs($member)
            ->patch("/tasks/{$assignedTask->id}/status", ['status' => TaskStatus::Completed->value])
            ->assertRedirect();

        $this->assertDatabaseHas('tasks', [
            'id' => $assignedTask->id,
            'status' => TaskStatus::Completed->value,
        ]);

        $this->actingAs($member)
            ->patch("/tasks/{$otherTask->id}/status", ['status' => TaskStatus::Completed->value])
            ->assertForbidden();
    }
}
