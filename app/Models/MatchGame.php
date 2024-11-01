<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MatchGame extends Model
{
    protected $table = 'partidos';

    protected $fillable = [
        'simulacion_id',
        'fase',
        'orden_partido',
        'fecha',
        'goles_local',
        'goles_visitante',
        'equipo_local_id',
        'equipo_visitante_id',
        'equipo_ganador_id',
        'tarjetas_rojas_local',
        'tarjetas_rojas_visitante',
        'tarjetas_amarillas_local',
        'tarjetas_amarillas_visitante'
    ];

    protected $casts = [
        'fecha' => 'date',
        'fecha_creacion' => 'datetime',
        'fecha_actualizacion' => 'datetime'
    ];

    public function simulacion(): BelongsTo
    {
        return $this->belongsTo(Simulation::class, 'simulacion_id');
    }

    public function equipoLocal(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'equipo_local_id');
    }

    public function equipoVisitante(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'equipo_visitante_id');
    }

    public function equipoGanador(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'equipo_ganador_id');
    }
}
