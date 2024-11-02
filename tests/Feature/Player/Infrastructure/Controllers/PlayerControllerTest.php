<?php

namespace Tests\Feature\Player\Infrastructure\Controllers;

use Tests\TestCase;
use App\Models\Team;
use App\Models\Player;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PlayerControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_view()
    {
        $response = $this->get(route('players.index'));
        $response->assertStatus(200);
        $response->assertViewIs('players.index');
    }

    public function test_get_players_list_returns_view()
    {
        // Crear equipo y jugadores de prueba
        $team = Team::factory()->create();
        $players = Player::factory()->count(3)->create([
            'equipo_id' => $team->id
        ]);

        $response = $this->get(route('players.list'));

        $response->assertStatus(200);
        $response->assertViewIs('players.list');
        $response->assertViewHas('jugadores');
    }

    public function test_store_creates_new_player()
    {
        $team = Team::factory()->create();
        $file = UploadedFile::fake()->image('player.jpg');

        $playerData = [
            'nombre' => 'Test Player',
            'posicion' => 'Delantero',
            'nacionalidad' => 'Argentina',
            'edad' => 25,
            'numero_camiseta' => 10,
            'url_foto' => $file,
            'equipo_id' => $team->id
        ];

        $response = $this->post(route('players.store'), $playerData);
        $response->assertStatus(201);
        $response->assertJson(['message' => 'Jugador creado correctamente.']);
    }
}
