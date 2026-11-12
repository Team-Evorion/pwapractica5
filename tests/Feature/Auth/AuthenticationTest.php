<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_user_can_log_in_and_read_their_profile(): void
    {
        $user = User::factory()->teamMember()->create([
            'email' => 'member@example.com',
        ]);

        $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ])->assertOk()
            ->assertJsonPath('data.email', $user->email)
            ->assertJsonPath('data.role.name', 'Miembro del equipo');

        $this->assertAuthenticatedAs($user);

        $this->getJson('/api/me')
            ->assertOk()
            ->assertJsonPath('data.id', $user->id);
    }

    public function test_invalid_credentials_are_rejected(): void
    {
        User::factory()->create(['email' => 'member@example.com']);

        $this->postJson('/api/login', [
            'email' => 'member@example.com',
            'password' => 'incorrect-password',
        ])->assertUnprocessable()
            ->assertJsonValidationErrors('email');

        $this->assertGuest();
    }

    public function test_authenticated_user_can_log_out(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->postJson('/api/logout')
            ->assertNoContent();

        $this->assertGuest();
    }
}
