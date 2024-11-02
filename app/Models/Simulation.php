<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Simulation extends Model
{
    protected $table = 'simulaciones';

    protected $casts = [
        'fecha_creacion' => 'datetime',
        'fecha_actualizacion' => 'datetime'
    ];

    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        'fecha_creacion'
    ];

    /**
     * Obtiene todos los partidos de la simulación
     */
    public function partidos(): HasMany
    {
        return $this->hasMany(MatchGame::class, 'simulacion_id');
    }

    /**
     * Obtiene todos los resultados de la simulación
     */
    public function resultados(): HasMany
    {
        return $this->hasMany(Result::class, 'simulacion_id');
    }
}
