<?php

namespace Src\Simulation\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use App\Exceptions\CustomJsonException;
use Src\Simulation\Application\UseCases\GetResultsUseCase;
use Src\Simulation\Infrastructure\Request\StoreSimulationRequest;
use Src\Simulation\Application\UseCases\CreateTournamentSimulationUseCase;

/**
 * Controlador para gestionar las simulaciones del torneo
 * @package Src\Simulation\Infrastructure\Controllers
 */
class SimulationController extends Controller
{
    /** @var CreateTournamentSimulationUseCase */
    private $createTournamentSimulationUseCase;

    /** @var GetResultsUseCase */
    private $getResultsUseCase;

    /**
     * Constructor del controlador
     * @param CreateTournamentSimulationUseCase $createTournamentSimulationUseCase
     */
    public function __construct(
        GetResultsUseCase $getResultsUseCase,
        CreateTournamentSimulationUseCase $createTournamentSimulationUseCase
    ) {
        $this->getResultsUseCase = $getResultsUseCase;
        $this->createTournamentSimulationUseCase = $createTournamentSimulationUseCase;
    }

    /**
     * Muestra la vista principal de simulaciones
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('simulations/index');
    }

    /**
     * Crea una nueva simulación de torneo
     * @param StoreSimulationRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws CustomJsonException
     */
    public function store(StoreSimulationRequest $request)
    {
        $result = $this->createTournamentSimulationUseCase->execute();
        if (!$result) {
            throw new CustomJsonException(['message' => 'Error al crear la simulación.']);
        }
        return response()->json(['message' => 'Simulación creada correctamente.'], 201);
    }

    /**
     * Obtiene y muestra los resultados de la simulación
     * @return \Illuminate\View\View
     */
    public function results()
    {
        $results = $this->getResultsUseCase->execute();
        return view('simulations/results', compact('results'));
    }
}

