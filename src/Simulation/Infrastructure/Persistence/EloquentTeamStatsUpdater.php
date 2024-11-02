<?php

namespace Src\Simulation\Infrastructure\Persistence;

use Src\Simulation\Domain\Entities\MatchGame;
use Src\Simulation\Domain\Repositories\TeamStatsUpdaterInterface;
use Src\Simulation\Domain\Repositories\ResultRepositoryInterface;

class EloquentTeamStatsUpdater implements TeamStatsUpdaterInterface
{
    private $resultRepository;

    public function __construct(ResultRepositoryInterface $resultRepository)
    {
        $this->resultRepository = $resultRepository;
    }

    public function updateStats(MatchGame $match, int $winnerId): void
    {
        $this->updateTeamStats(
            $match->getSimulacionId(),
            $match->getEquipoLocalId(),
            $match->getGolesLocal(),
            $match->getGolesVisitante(),
            $match->getTarjetasAmarillasLocal(),
            $match->getTarjetasRojasLocal(),
            $winnerId === $match->getEquipoLocalId()
        );

        $this->updateTeamStats(
            $match->getSimulacionId(),
            $match->getEquipoVisitanteId(),
            $match->getGolesVisitante(),
            $match->getGolesLocal(),
            $match->getTarjetasAmarillasVisitante(),
            $match->getTarjetasRojasVisitante(),
            $winnerId === $match->getEquipoVisitanteId()
        );
    }

    private function updateTeamStats(
        int $simulationId,
        int $teamId,
        int $golesFavor,
        int $golesContra,
        int $tarjetasAmarillas,
        int $tarjetasRojas,
        bool $isWinner
    ): void {
        $result = $this->resultRepository->findByTeamAndSimulation($teamId, $simulationId);

        $result->updateMatchStats(
            $golesFavor,
            $golesContra,
            $tarjetasAmarillas,
            $tarjetasRojas,
            $isWinner
        );

        $this->resultRepository->save($result);
    }
}
