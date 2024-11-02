<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Result extends Model
{
    protected $table = 'resultados';

    protected $fillable = [
        'simulacion_id',
        'equipo_id',
        'eliminado',
        'campeon',
        'partidos_jugados',
        'partidos_ganados',
        'partidos_perdidos',
        'goles_favor',
        'goles_contra',
        'tarjetas_amarillas_totales',
        'tarjetas_rojas_totales',
        'posicion_final'
    ];

    protected $casts = [
        'campeon' => 'boolean',
        'eliminado' => 'boolean',
        'fecha_creacion' => 'datetime',
        'fecha_actualizacion' => 'datetime'
    ];

    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_actualizacion';

    public function simulacion(): BelongsTo
    {
        return $this->belongsTo(Simulation::class, 'simulacion_id');
    }

    public function equipo(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'equipo_id');
    }
}
