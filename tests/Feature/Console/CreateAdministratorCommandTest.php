<?php

namespace Tests\Feature\Console;

use App\Models\User;
use App\RoleName;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class CreateAdministratorCommandTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_command_creates_an_administrator(): void
    {
        $this->artisan('app:create-administrator', [
            '--name' => 'Admin Principal',
            '--email' => 'admin@example.com',
            '--password' => 'secure-password',
        ])->expectsOutput('Administrador creado: admin@example.com')
            ->assertSuccessful();

        $administrator = User::query()->with('role')->where('email', 'admin@example.com')->firstOrFail();

        $this->assertTrue($administrator->hasRole(RoleName::Administrator));
        $this->assertNotSame('secure-password', $administrator->password);
    }
}
