<?php

namespace Tests\Feature\Team\Infrastructure\Controllers;

use Tests\TestCase;
use App\Models\Team;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TeamControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_view()
    {
        $response = $this->get(route('teams.index'));

        $response->assertStatus(200);
        $response->assertViewIs('teams.index');
    }

    public function test_get_teams_list_returns_view()
    {
        // Crear algunos equipos de prueba
        Team::factory()->count(3)->create();

        $response = $this->get(route('teams.list'));

        $response->assertStatus(200);
        $response->assertViewIs('teams.list');
        $response->assertViewHas('equipos');
    }

    public function test_store_creates_new_team()
    {
        $file = UploadedFile::fake()->image('flag.jpg');

        $teamData = [
            'nombre' => 'Test Team',
            'pais' => 'Test Country',
            'url_bandera' => $file
        ];

        $response = $this->post(route('teams.store'), $teamData);

        $response->assertStatus(201);
        $response->assertJson(['message' => 'Equipo creado correctamente.']);

        $this->assertDatabaseHas('equipos', [
            'nombre' => 'Test Team',
            'pais' => 'Test Country'
        ]);
    }
}
