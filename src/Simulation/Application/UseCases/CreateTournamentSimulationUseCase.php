<?php

namespace Src\Simulation\Application\UseCases;

use Src\Simulation\Domain\Entities\Result;
use Src\Simulation\Domain\Entities\MatchGame;
use Src\Simulation\Domain\Entities\Simulation;
use Src\Team\Domain\Repositories\TeamRepositoryInterface;
use Src\Simulation\Domain\Repositories\TeamStatsUpdaterInterface;
use Src\Simulation\Domain\Repositories\ResultRepositoryInterface;
use Src\Simulation\Domain\Repositories\MatchGameRepositoryInterface;
use Src\Simulation\Domain\Repositories\SimulationRepositoryInterface;
use Src\Simulation\Domain\Repositories\MatchWinnerDeterminerInterface;

/**
 * Caso de uso para crear y ejecutar una simulación de torneo
 */
class CreateTournamentSimulationUseCase
{
    private $simulationRepository;
    private $matchGameRepository;
    private $teamRepository;
    private $matchWinnerDeterminer;
    private $statsUpdater;
    private $resultRepository;
    private $remainingTeams;

    public function __construct(
        SimulationRepositoryInterface $simulationRepository,
        MatchGameRepositoryInterface $matchGameRepository,
        TeamRepositoryInterface $teamRepository,
        MatchWinnerDeterminerInterface $matchWinnerDeterminer,
        TeamStatsUpdaterInterface $statsUpdater,
        ResultRepositoryInterface $resultRepository
    ) {
        $this->simulationRepository = $simulationRepository;
        $this->matchGameRepository = $matchGameRepository;
        $this->teamRepository = $teamRepository;
        $this->matchWinnerDeterminer = $matchWinnerDeterminer;
        $this->statsUpdater = $statsUpdater;
        $this->resultRepository = $resultRepository;
    }

    /**
     * Ejecuta la simulación del torneo
     * @return bool
     */
    public function execute(): bool
    {
        // Limpiar datos anteriores
        $this->simulationRepository->deleteAll();

        $simulationCreated = true;
        // 1. Crear simulación
        $simulation = new Simulation(['fecha_creacion' => now()]);
        $saved = $this->simulationRepository->save($simulation);

        if (!$saved || !$simulation->getId()) {
            return false;
        }

        // 2. Obtener y mezclar equipos aleatoriamente
        $teams = collect($this->teamRepository->findAll());
        $shuffledTeams = $teams->shuffle()->values()->all();

        // Inicializar resultados para cada equipo
        foreach ($shuffledTeams as $team) {
            $result = new Result([
                'simulacion_id' => $simulation->getId(),
                'equipo_id' => $team['id'],
                'eliminado' => false,
                'campeon' => false,
                'partidos_jugados' => 0,
                'partidos_ganados' => 0,
                'partidos_perdidos' => 0,
                'goles_favor' => 0,
                'goles_contra' => 0,
                'tarjetas_amarillas_totales' => 0,
                'tarjetas_rojas_totales' => 0
            ]);
            $this->resultRepository->save($result);
        }

        // 3. Crear encuentros aleatorios
        $this->createKnockoutMatches($simulation->getId(), $shuffledTeams);
        return $simulationCreated;
    }

    /**
     * Crea los encuentros de eliminación directa
     * @param int $simulationId
     * @param array $teams
     */
    private function createKnockoutMatches(int $simulationId, array $teams): void
    {
        $this->remainingTeams = $teams;
        $matchOrder = 1;
        $currentPosition = count($teams);

        while (count($this->remainingTeams) > 1) {
            $currentTeams = $this->remainingTeams;
            $winners = [];

            for ($i = 0; $i < count($currentTeams); $i += 2) {
                if (!isset($currentTeams[$i + 1])) break;

                $match = $this->createMatch(
                    $simulationId,
                    $currentTeams[$i]['id'],
                    $currentTeams[$i + 1]['id'],
                    $matchOrder++
                );

                // Determinar ganador
                $winnerId = $match->getEquipoGanadorId();
                $loserId = $winnerId === $match->getEquipoLocalId()
                    ? $match->getEquipoVisitanteId()
                    : $match->getEquipoLocalId();

                // Marcar equipo como eliminado y asignar posición
                $this->resultRepository->eliminateTeam($simulationId, $loserId);
                $this->resultRepository->updatePosition($simulationId, $loserId, $currentPosition);
                $currentPosition--;

                // Agregar ganador a la siguiente ronda
                $winningTeam = $winnerId === $currentTeams[$i]['id']
                    ? $currentTeams[$i]
                    : $currentTeams[$i + 1];
                $winners[] = $winningTeam;

                // Actualizar estadísticas
                $this->statsUpdater->updateStats($match, $winnerId);
            }

            $this->remainingTeams = $winners;
        }

        // Establecer campeón y su posición
        if (count($this->remainingTeams) === 1) {
            $champion = $this->remainingTeams[0];
            $this->resultRepository->setChampion($simulationId, $champion['id']);
            $this->resultRepository->updatePosition($simulationId, $champion['id'], 1);
        }
    }

    private function createMatch(int $simulationId, int $localId, int $visitorId, int $matchOrder): MatchGame
    {
        $matchData = [
            'simulacion_id' => $simulationId,
            'equipo_local_id' => $localId,
            'equipo_visitante_id' => $visitorId,
            'orden_partido' => $matchOrder,
            'goles_local' => rand(0, 5),
            'goles_visitante' => rand(0, 5),
            'tarjetas_amarillas_local' => rand(0, 3),
            'tarjetas_amarillas_visitante' => rand(0, 3),
            'tarjetas_rojas_local' => rand(0, 1),
            'tarjetas_rojas_visitante' => rand(0, 1)
        ];

        $match = new MatchGame($matchData);
        $match->setEquipoGanadorId($this->matchWinnerDeterminer->determineWinner($match));
        $this->matchGameRepository->save($match);

        return $match;
    }
}
