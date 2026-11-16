<?php

namespace Tests\Feature\Models;

use App\Models\Role;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_role_seeder_creates_required_roles_without_duplicates(): void
    {
        $this->seed(RoleSeeder::class);
        $this->seed(RoleSeeder::class);

        $this->assertDatabaseCount('roles', 3);
        $this->assertDatabaseHas('roles', ['name' => 'Administrador']);
        $this->assertDatabaseHas('roles', ['name' => 'Gerente de proyecto']);
        $this->assertDatabaseHas('roles', ['name' => 'Miembro del equipo']);
    }

    public function test_user_belongs_to_role_and_role_contains_users(): void
    {
        $role = Role::factory()->create();
        $user = User::factory()->for($role)->create();

        $this->assertTrue($user->role->is($role));
        $this->assertTrue($role->users->contains($user));
    }

    public function test_role_with_assigned_users_cannot_be_deleted(): void
    {
        $role = Role::factory()->create();
        User::factory()->for($role)->create();

        $this->expectException(QueryException::class);

        $role->delete();
    }
}
