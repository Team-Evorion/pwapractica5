<?php

namespace Tests\Feature\Web;

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class WebAuthenticationTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_guest_sees_login_and_cannot_open_dashboard(): void
    {
        $this->get('/login')
            ->assertOk()
            ->assertSee('Iniciar sesión');

        $this->get('/dashboard')->assertRedirect('/login');
    }

    public function test_valid_credentials_open_the_role_dashboard(): void
    {
        $user = User::factory()->teamMember()->create([
            'email' => 'member@example.com',
        ]);

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ])->assertRedirect('/dashboard');

        $this->assertAuthenticatedAs($user);
        $this->get('/dashboard')
            ->assertOk()
            ->assertSee('Panel Miembro del equipo')
            ->assertSee($user->name);
    }

    public function test_invalid_credentials_return_to_login_with_error(): void
    {
        User::factory()->teamMember()->create(['email' => 'member@example.com']);

        $this->from('/login')->post('/login', [
            'email' => 'member@example.com',
            'password' => 'incorrect-password',
        ])->assertRedirect('/login')
            ->assertSessionHasErrors('email');

        $this->assertGuest();
    }
}
