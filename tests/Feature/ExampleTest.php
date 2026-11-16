<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_public_home_presents_the_project(): void
    {
        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertSee('Gestión clara para')
            ->assertSee('equipos que avanzan.')
            ->assertSee(route('team'));
    }

    public function test_team_page_presents_the_six_members(): void
    {
        $response = $this->get('/equipo');

        $response
            ->assertOk()
            ->assertSee('Seis personas.')
            ->assertSee('Una misma dirección.')
            ->assertSee('Jesús Rafael Fernández Pérez')
            ->assertSee('José Andrés Merlin Gamboa')
            ->assertSee('José Alberto Rosado Domínguez')
            ->assertSee('Terry Steven Ponce Farías')
            ->assertSee('Elkin Daniel Velastegui Zambrano')
            ->assertSee('Zahid Joel Zambrano Moreira');
    }
}
