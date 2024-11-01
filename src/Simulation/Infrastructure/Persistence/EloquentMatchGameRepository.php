<?php

namespace Src\Simulation\Infrastructure\Persistence;

use Src\Simulation\Domain\Entities\MatchGame;
use Src\Simulation\Domain\Repositories\MatchGameRepositoryInterface;
use App\Models\MatchGame as EloquentMatchGame;

class EloquentMatchGameRepository implements MatchGameRepositoryInterface
{
    public function save(MatchGame $match): void
    {
        $eloquentMatch = new EloquentMatchGame();

        if ($match->getId()) {
            $eloquentMatch = EloquentMatchGame::findOrNew($match->getId());
        }

        $eloquentMatch->simulacion_id = $match->getSimulacionId();
        $eloquentMatch->fase = $match->getFase();
        $eloquentMatch->orden_partido = $match->getOrdenPartido();
        $eloquentMatch->fecha = $match->getFecha();
        $eloquentMatch->goles_local = $match->getGolesLocal();
        $eloquentMatch->goles_visitante = $match->getGolesVisitante();
        $eloquentMatch->equipo_local_id = $match->getEquipoLocalId();
        $eloquentMatch->equipo_visitante_id = $match->getEquipoVisitanteId();
        $eloquentMatch->equipo_ganador_id = $match->getEquipoGanadorId();
        $eloquentMatch->tarjetas_rojas_local = $match->getTarjetasRojasLocal();
        $eloquentMatch->tarjetas_rojas_visitante = $match->getTarjetasRojasVisitante();
        $eloquentMatch->tarjetas_amarillas_local = $match->getTarjetasAmarillasLocal();
        $eloquentMatch->tarjetas_amarillas_visitante = $match->getTarjetasAmarillasVisitante();

        $eloquentMatch->save();
    }

    public function findBySimulationId(int $simulacionId): array
    {
        return EloquentMatchGame::where('simulacion_id', $simulacionId)
            ->orderBy('orden_partido')
            ->get()
            ->toArray();
    }

    public function findByFase(int $simulacionId, string $fase): array
    {
        return EloquentMatchGame::where('simulacion_id', $simulacionId)
            ->where('fase', $fase)
            ->orderBy('orden_partido')
            ->get()
            ->toArray();
    }

    public function findByTeam(int $simulacionId, int $equipoId): array
    {
        return EloquentMatchGame::where('simulacion_id', $simulacionId)
            ->where(function($query) use ($equipoId) {
                $query->where('equipo_local_id', $equipoId)
                      ->orWhere('equipo_visitante_id', $equipoId);
            })
            ->orderBy('orden_partido')
            ->get()
            ->toArray();
    }

    public function getLastMatchByTeam(int $simulacionId, int $equipoId): ?MatchGame
    {
        $match = EloquentMatchGame::where('simulacion_id', $simulacionId)
            ->where(function($query) use ($equipoId) {
                $query->where('equipo_local_id', $equipoId)
                      ->orWhere('equipo_visitante_id', $equipoId);
            })
            ->orderBy('orden_partido', 'desc')
            ->first();

        return $match ? new MatchGame($match->toArray()) : null;
    }
}
