<?php

namespace Src\Simulation\Infrastructure\Persistence;

use Src\Simulation\Domain\Repositories\MatchWinnerDeterminerInterface;
use Src\Simulation\Domain\Repositories\ResultRepositoryInterface;
use Src\Simulation\Domain\Entities\MatchGame;

class EloquentMatchWinnerDeterminer implements MatchWinnerDeterminerInterface
{
    private $resultRepository;

    public function __construct(ResultRepositoryInterface $resultRepository)
    {
        $this->resultRepository = $resultRepository;
    }

    public function determineWinner(MatchGame $match): int
    {
        $localId = $match->getEquipoLocalId();
        $visitorId = $match->getEquipoVisitanteId();

        if ($match->getGolesLocal() !== $match->getGolesVisitante()) {
            return $match->getGolesLocal() > $match->getGolesVisitante() ? $localId : $visitorId;
        }

        $localStats = $this->resultRepository->findByTeamAndSimulation($localId, $match->getSimulacionId());
        $visitorStats = $this->resultRepository->findByTeamAndSimulation($visitorId, $match->getSimulacionId());

        switch (true) {
            case $localStats->getPartidosPerdidos() !== $visitorStats->getPartidosPerdidos():
                return $localStats->getPartidosPerdidos() < $visitorStats->getPartidosPerdidos() ? $localId : $visitorId;
            case $localStats->getGolesFavor() !== $visitorStats->getGolesFavor():
                return $localStats->getGolesFavor() > $visitorStats->getGolesFavor() ? $localId : $visitorId;
            case $localStats->getTarjetasRojasTotales() !== $visitorStats->getTarjetasRojasTotales():
                return $localStats->getTarjetasRojasTotales() < $visitorStats->getTarjetasRojasTotales() ? $localId : $visitorId;
            case $localStats->getTarjetasAmarillasTotales() !== $visitorStats->getTarjetasAmarillasTotales():
                return $localStats->getTarjetasAmarillasTotales() < $visitorStats->getTarjetasAmarillasTotales() ? $localId : $visitorId;
            default:
                return rand(0, 1) === 0 ? $localId : $visitorId;
        }
    }
}
