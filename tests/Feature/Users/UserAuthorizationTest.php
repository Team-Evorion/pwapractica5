<?php

namespace Tests\Feature\Users;

use App\Models\Role;
use App\Models\User;
use App\RoleName;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class UserAuthorizationTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_administrator_can_manage_users(): void
    {
        $administrator = User::factory()->administrator()->create();
        $role = Role::query()->firstOrCreate(['name' => RoleName::TeamMember->value]);

        $response = $this->actingAs($administrator)->postJson('/api/users', [
            'role_id' => $role->id,
            'name' => 'Nuevo miembro',
            'email' => 'new-member@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ])->assertCreated()
            ->assertJsonPath('data.role.name', RoleName::TeamMember->value);

        $userId = $response->json('data.id');

        $this->actingAs($administrator)
            ->patchJson("/api/users/{$userId}", ['name' => 'Nombre actualizado'])
            ->assertOk()
            ->assertJsonPath('data.name', 'Nombre actualizado');

        $this->actingAs($administrator)
            ->deleteJson("/api/users/{$userId}")
            ->assertNoContent();

        $this->assertDatabaseMissing('users', ['id' => $userId]);
    }

    public function test_non_administrator_cannot_access_user_management(): void
    {
        $member = User::factory()->teamMember()->create();

        $this->actingAs($member)
            ->getJson('/api/users')
            ->assertForbidden();
    }

    public function test_administrator_cannot_delete_their_own_account(): void
    {
        $administrator = User::factory()->administrator()->create();

        $this->actingAs($administrator)
            ->deleteJson("/api/users/{$administrator->id}")
            ->assertForbidden();

        $this->assertDatabaseHas('users', ['id' => $administrator->id]);
    }
}
