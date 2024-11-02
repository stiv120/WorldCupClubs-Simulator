<?php

namespace Database\Factories;

use App\Models\Simulation;
use Illuminate\Database\Eloquent\Factories\Factory;

class SimulationFactory extends Factory
{
    protected $model = Simulation::class;

    public function definition()
    {
        return [
            'estado' => 'completado',
            'fecha_creacion' => now(),
            'fecha_actualizacion' => now()
        ];
    }
}
