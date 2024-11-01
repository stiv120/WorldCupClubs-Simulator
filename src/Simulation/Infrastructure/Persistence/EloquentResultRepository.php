<?php

namespace Src\Simulation\Infrastructure\Persistence;

use Src\Simulation\Domain\Entities\Result;
use Src\Simulation\Domain\Repositories\ResultRepositoryInterface;
use App\Models\Result as EloquentResult;

class EloquentResultRepository implements ResultRepositoryInterface
{
    public function save(Result $result): void
    {
        $eloquentResult = new EloquentResult();

        if ($result->getId()) {
            $eloquentResult = EloquentResult::findOrNew($result->getId());
        }

        $eloquentResult->simulacion_id = $result->getSimulacionId();
        $eloquentResult->equipo_id = $result->getEquipoId();
        $eloquentResult->eliminado = $result->isEliminado();
        $eloquentResult->campeon = $result->isCampeon();
        $eloquentResult->partidos_jugados = $result->getPartidosJugados();
        $eloquentResult->partidos_ganados = $result->getPartidosGanados();
        $eloquentResult->partidos_perdidos = $result->getPartidosPerdidos();
        $eloquentResult->goles_favor = $result->getGolesFavor();
        $eloquentResult->goles_contra = $result->getGolesContra();
        $eloquentResult->tarjetas_amarillas_totales = $result->getTarjetasAmarillasTotales();
        $eloquentResult->tarjetas_rojas_totales = $result->getTarjetasRojasTotales();
        $eloquentResult->posicion_final = $result->getPosicionFinal();

        $eloquentResult->save();
    }

    public function findBySimulationId(int $simulacionId): array
    {
        return EloquentResult::where('simulacion_id', $simulacionId)
            ->get()
            ->toArray();
    }

    public function findByTeam(int $simulacionId, int $equipoId): ?Result
    {
        $result = EloquentResult::where('simulacion_id', $simulacionId)
            ->where('equipo_id', $equipoId)
            ->first();

        return $result ? new Result($result->toArray()) : null;
    }

    public function updateTeamStats(int $simulacionId, int $equipoId, array $stats): void
    {
        EloquentResult::where('simulacion_id', $simulacionId)
            ->where('equipo_id', $equipoId)
            ->update($stats);
    }

    public function getWinner(int $simulacionId): ?Result
    {
        $winner = EloquentResult::where('simulacion_id', $simulacionId)
            ->where('campeon', true)
            ->first();

        return $winner ? new Result($winner->toArray()) : null;
    }

    public function eliminateTeam(int $simulacionId, int $equipoId): void
    {
        EloquentResult::where('simulacion_id', $simulacionId)
            ->where('equipo_id', $equipoId)
            ->update(['eliminado' => true]);
    }

    public function setChampion(int $simulacionId, int $equipoId): void
    {
        EloquentResult::where('simulacion_id', $simulacionId)
            ->where('equipo_id', $equipoId)
            ->update(['campeon' => true]);
    }
}
