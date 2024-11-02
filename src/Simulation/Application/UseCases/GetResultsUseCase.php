<?php

namespace Src\Simulation\Application\UseCases;

use Src\Team\Domain\Repositories\TeamRepositoryInterface;
use Src\Simulation\Domain\Repositories\ResultRepositoryInterface;
use Src\Simulation\Domain\Repositories\MatchGameRepositoryInterface;
use Src\Simulation\Domain\Repositories\SimulationRepositoryInterface;

/**
 * Caso de uso para obtener todos los resultados de la simulación
 * @package Src\Simulation\Application\UseCases
 */
class GetResultsUseCase
{
    /**
     * Repositorio de simulaciones
     * @var ResultRepositoryInterface
     */
    private $resultRepository;
    private $matchGameRepository;
    private $simulationRepository;
    private $teamRepository;

    /**
     * Constructor del caso de uso
     * @param resultReInterface $simula Repositorio para consulta de jugadores
     */
    public function __construct(
        ResultRepositoryInterface $resultRepository,
        MatchGameRepositoryInterface $matchGameRepository,
        SimulationRepositoryInterface $simulationRepository,
        TeamRepositoryInterface $teamRepository
    ) {
        $this->resultRepository = $resultRepository;
        $this->matchGameRepository = $matchGameRepository;
        $this->simulationRepository = $simulationRepository;
        $this->teamRepository = $teamRepository;
    }

    /**
     * Ejecuta el caso de uso para obtener todos los resultados de la simulación
     * @return array Lista de todos los resultados de la simulación
     */
    public function execute(): array
    {
        $lastSimulation = $this->simulationRepository->getLastSimulation();

        if (!$lastSimulation) {
            return [];
        }

        $simulationId = $lastSimulation->getId();

        // Obtener todos los partidos ordenados
        $matches = $this->matchGameRepository->findBySimulationId($simulationId);

        // Obtener todos los resultados de equipos
        $results = $this->resultRepository->findBySimulationId($simulationId);

        // Obtener el campeón
        $champion = $this->resultRepository->getWinner($simulationId);

        return [
            'encuentros' => array_map(function($match) {
                $equipoLocal = $this->teamRepository->findById($match['equipo_local_id']);
                $equipoVisitante = $this->teamRepository->findById($match['equipo_visitante_id']);
                $equipoGanador = $match['equipo_ganador_id'] ? $this->teamRepository->findById($match['equipo_ganador_id']) : null;

                return [
                    'orden' => $match['orden_partido'],
                    'equipo_local' => [
                        'id' => $match['equipo_local_id'],
                        'nombre' => $equipoLocal->getNombre()
                    ],
                    'equipo_visitante' => [
                        'id' => $match['equipo_visitante_id'],
                        'nombre' => $equipoVisitante->getNombre()
                    ],
                    'goles_local' => $match['goles_local'],
                    'goles_visitante' => $match['goles_visitante'],
                    'ganador' => $equipoGanador ? [
                        'id' => $equipoGanador->getId(),
                        'nombre' => $equipoGanador->getNombre()
                    ] : null,
                    'tarjetas' => [
                        'local' => [
                            'amarillas' => $match['tarjetas_amarillas_local'],
                            'rojas' => $match['tarjetas_rojas_local']
                        ],
                        'visitante' => [
                            'amarillas' => $match['tarjetas_amarillas_visitante'],
                            'rojas' => $match['tarjetas_rojas_visitante']
                        ]
                    ]
                ];
            }, $matches),
            'equipos' => array_map(function($result) {
                $equipo = $this->teamRepository->findById($result['equipo_id']);
                return [
                    'equipo' => [
                        'id' => $result['equipo_id'],
                        'nombre' => $equipo->getNombre()
                    ],
                    'posicion_final' => $result['posicion_final'],
                    'eliminado' => $result['eliminado'],
                    'estadisticas' => [
                        'partidos_ganados' => $result['partidos_ganados'],
                        'partidos_perdidos' => $result['partidos_perdidos'],
                        'goles_favor' => $result['goles_favor'],
                        'goles_contra' => $result['goles_contra'],
                        'tarjetas_amarillas' => $result['tarjetas_amarillas_totales'],
                        'tarjetas_rojas' => $result['tarjetas_rojas_totales']
                    ]
                ];
            }, $results),
            'campeon' => $champion ? [
                'equipo' => [
                    'id' => $champion->getEquipoId(),
                    'nombre' => $this->teamRepository->findById($champion->getEquipoId())->getNombre()
                ],
                'estadisticas' => [
                    'partidos_ganados' => $champion->getPartidosGanados(),
                    'goles_favor' => $champion->getGolesFavor(),
                    'tarjetas_amarillas' => $champion->getTarjetasAmarillasTotales(),
                    'tarjetas_rojas' => $champion->getTarjetasRojasTotales()
                ]
            ] : null
        ];
    }
}
