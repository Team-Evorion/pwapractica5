<?php

namespace Tests\Feature\Web;

use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use App\RoleName;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class WebWorkflowTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_administrator_creates_user_from_web_form(): void
    {
        $administrator = User::factory()->administrator()->create();
        $memberRole = Role::query()->firstOrCreate(['name' => RoleName::TeamMember->value]);

        $this->actingAs($administrator)
            ->post('/users', [
                'role_id' => $memberRole->id,
                'name' => 'Miembro Nuevo',
                'email' => 'nuevo@example.com',
                'password' => 'password123',
                'password_confirmation' => 'password123',
            ])->assertRedirect('/users');

        $this->assertDatabaseHas('users', [
            'name' => 'Miembro Nuevo',
            'email' => 'nuevo@example.com',
            'role_id' => $memberRole->id,
        ]);
    }

    public function test_administrator_creates_project_with_manager_and_members(): void
    {
        $administrator = User::factory()->administrator()->create();
        $manager = User::factory()->projectManager()->create();
        $member = User::factory()->teamMember()->create();

        $response = $this->actingAs($administrator)->post('/projects', [
            'manager_id' => $manager->id,
            'name' => 'Sistema académico',
            'description' => 'Proyecto creado desde la interfaz web.',
            'member_ids' => [$member->id],
        ]);

        $project = Project::query()->where('name', 'Sistema académico')->firstOrFail();

        $response->assertRedirect("/projects/{$project->id}");
        $this->assertDatabaseHas('project_user', [
            'project_id' => $project->id,
            'user_id' => $member->id,
        ]);
    }

    public function test_manager_creates_task_from_web_form(): void
    {
        $manager = User::factory()->projectManager()->create();
        $member = User::factory()->teamMember()->create();
        $project = Project::factory()->for($manager, 'manager')->create();
        $project->members()->attach($member);

        $this->actingAs($manager)
            ->post("/projects/{$project->id}/tasks", [
                'assigned_to' => $member->id,
                'title' => 'Integrar interfaz',
                'description' => 'Conectar formularios con el backend.',
            ])->assertRedirect("/projects/{$project->id}");

        $this->assertDatabaseHas('tasks', [
            'project_id' => $project->id,
            'assigned_to' => $member->id,
            'title' => 'Integrar interfaz',
        ]);
    }
}
