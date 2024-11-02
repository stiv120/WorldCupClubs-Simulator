<?php

namespace Database\Factories;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlayerFactory extends Factory
{
    protected $model = Player::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->name,
            'posicion' => $this->faker->randomElement(['Portero', 'Defensa', 'Mediocampista', 'Delantero']),
            'nacionalidad' => $this->faker->country,
            'edad' => $this->faker->numberBetween(18, 40),
            'numero_camiseta' => $this->faker->unique()->numberBetween(1, 99),
            'url_foto' => $this->faker->imageUrl(640, 480, 'people'),
            'equipo_id' => Team::factory(),
            'fecha_creacion' => now(),
            'fecha_actualizacion' => now()
        ];
    }
}
