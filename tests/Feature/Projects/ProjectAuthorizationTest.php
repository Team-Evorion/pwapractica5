<?php

namespace Tests\Feature\Projects;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class ProjectAuthorizationTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_administrator_can_create_project_and_assign_members(): void
    {
        $administrator = User::factory()->administrator()->create();
        $manager = User::factory()->projectManager()->create();
        $member = User::factory()->teamMember()->create();

        $response = $this->actingAs($administrator)->postJson('/api/projects', [
            'manager_id' => $manager->id,
            'name' => 'Portal académico',
            'description' => 'Proyecto de prueba',
            'member_ids' => [$member->id],
        ])->assertCreated()
            ->assertJsonPath('data.manager.id', $manager->id)
            ->assertJsonPath('data.members.0.id', $member->id);

        $this->assertDatabaseHas('project_user', [
            'project_id' => $response->json('data.id'),
            'user_id' => $member->id,
        ]);
    }

    public function test_each_user_only_sees_projects_related_to_them(): void
    {
        $manager = User::factory()->projectManager()->create();
        $otherManager = User::factory()->projectManager()->create();
        $member = User::factory()->teamMember()->create();
        $otherMember = User::factory()->teamMember()->create();
        $ownedProject = Project::factory()->for($manager, 'manager')->create();
        $otherProject = Project::factory()->for($otherManager, 'manager')->create();
        $ownedProject->members()->attach($member);
        $otherProject->members()->attach($otherMember);

        $this->actingAs($manager)
            ->getJson('/api/projects')
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.id', $ownedProject->id);

        $this->actingAs($member)
            ->getJson('/api/projects')
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.id', $ownedProject->id);

        $this->actingAs($member)
            ->getJson("/api/projects/{$otherProject->id}")
            ->assertForbidden();
    }

    public function test_only_administrator_can_update_or_delete_projects(): void
    {
        $manager = User::factory()->projectManager()->create();
        $project = Project::factory()->for($manager, 'manager')->create();

        $this->actingAs($manager)
            ->patchJson("/api/projects/{$project->id}", ['name' => 'No permitido'])
            ->assertForbidden();

        $this->actingAs($manager)
            ->deleteJson("/api/projects/{$project->id}")
            ->assertForbidden();
    }
}
