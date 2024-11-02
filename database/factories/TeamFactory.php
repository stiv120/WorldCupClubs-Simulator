<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory
{
    protected $model = Team::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->unique()->company,
            'pais' => $this->faker->country,
            'url_bandera' => $this->faker->imageUrl(640, 480, 'flag'),
            'fecha_creacion' => now(),
            'fecha_actualizacion' => now()
        ];
    }
}
