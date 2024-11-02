<?php

namespace Tests\Feature\Simulation\Infrastructure\Controllers;

use Tests\TestCase;
use App\Models\Team;
use App\Models\Player;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SimulationControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_view()
    {
        $response = $this->get(route('simulations.index'));
        $response->assertStatus(200);
        $response->assertViewIs('simulations.index');
    }

    public function test_store_creates_new_simulation()
    {
        // Crear equipos con jugadores
        $teams = Team::factory()->count(8)->create();

        // Crear 11 jugadores para cada equipo
        foreach ($teams as $team) {
            Player::factory()->count(11)->create([
                'equipo_id' => $team->id
            ]);
        }

        $simulationData = [
            'equipos' => $teams->pluck('id')->toArray()
        ];

        $response = $this->post(route('simulations.store'), $simulationData);
        $response->assertStatus(201);
        $response->assertJson(['message' => 'Simulación creada correctamente.']);
    }

    public function test_results_returns_view()
    {
        // Crear una simulación manualmente
        DB::table('simulaciones')->insert([
            'fecha_creacion' => now(),
            'fecha_actualizacion' => now()
        ]);

        $response = $this->get(route('simulations.results'));
        $response->assertStatus(200);
        $response->assertViewIs('simulations.results');
    }
}
