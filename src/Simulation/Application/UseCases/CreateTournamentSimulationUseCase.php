<?php

namespace Src\Simulation\Application\UseCases;

use Src\Simulation\Domain\Entities\Simulation;
use Src\Simulation\Domain\Entities\MatchGame;
use Src\Simulation\Domain\Entities\Result;
use Src\Simulation\Domain\Repositories\SimulationRepositoryInterface;
use Src\Simulation\Domain\Repositories\MatchGameRepositoryInterface;
use Src\Simulation\Domain\Repositories\ResultRepositoryInterface;
use Src\Team\Domain\Repositories\TeamRepositoryInterface;

class CreateTournamentSimulationUseCase
{
    private $simulationRepository;
    private $matchGameRepository;
    private $resultRepository;
    private $teamRepository;

    public function __construct(
        SimulationRepositoryInterface $simulationRepository,
        MatchGameRepositoryInterface $matchGameRepository,
        ResultRepositoryInterface $resultRepository,
        TeamRepositoryInterface $teamRepository
    ) {
        $this->simulationRepository = $simulationRepository;
        $this->matchGameRepository = $matchGameRepository;
        $this->resultRepository = $resultRepository;
        $this->teamRepository = $teamRepository;
    }

    public function execute(): bool
    {
        // 1. Crear simulación
        $simulation = new Simulation(['fecha_creacion' => now()]);
        if (!$this->simulationRepository->save($simulation)) {
            return false;
        }

        // 2. Obtener y mezclar equipos aleatoriamente
        $teams = $this->teamRepository->getActiveTeams();
        shuffle($teams);

        // 3. Crear y simular partidos
        $remainingTeams = $teams;
        $matchOrder = 1;

        while (count($remainingTeams) > 1) {
            $matchPairs = array_chunk($remainingTeams, 2);
            $winners = [];

            foreach ($matchPairs as $pair) {
                $match = $this->createMatch($simulation->getId(), $pair[0], $pair[1], $matchOrder++);
                $this->matchGameRepository->save($match);

                // Actualizar estadísticas y determinar ganador
                $this->updateTeamStats($simulation->getId(), $match);
                $winners[] = $this->determineWinner($match);
            }

            $remainingTeams = $winners;
        }

        // 4. Establecer campeón
        $champion = reset($remainingTeams);
        $this->resultRepository->setChampion($simulation->getId(), $champion['id']);

        return true;
    }

    private function createMatch(int $simulationId, array $localTeam, array $awayTeam, int $order): MatchGame
    {
        return new MatchGame([
            'simulacion_id' => $simulationId,
            'equipo_local_id' => $localTeam['id'],
            'equipo_visitante_id' => $awayTeam['id'],
            'orden_partido' => $order,
            'goles_local' => rand(0, 5),
            'goles_visitante' => rand(0, 5),
            'tarjetas_amarillas_local' => rand(0, 5),
            'tarjetas_amarillas_visitante' => rand(0, 5),
            'tarjetas_rojas_local' => rand(0, 2),
            'tarjetas_rojas_visitante' => rand(0, 2),
        ]);
    }

    private function determineWinner(MatchGame $match): array
    {
        // Implementar lógica de desempate según las reglas especificadas
    }

    private function updateTeamStats(int $simulationId, MatchGame $match): void
    {
        // Actualizar estadísticas de ambos equipos
    }
}
