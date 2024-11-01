<?php

namespace Src\Simulation\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use App\Exceptions\CustomJsonException;
use Src\Simulation\Infrastructure\Request\StoreSimulationRequest;
use Src\Simulation\Application\UseCases\CreateTournamentSimulationUseCase;

/**
 * Controlador para la gestión de Simulaciones
 * @package Src\Simulation\Infrastructure\Controllers
 */
class SimulationController extends Controller
{
    /** @var CreateTournamentSimulationUseCase */
    private $createTournamentSimulationUseCase;

    /**
     * Constructor del controlador
     * @param CreateTournamentSimulationUseCase $createTournamentSimulationUseCase
     */
    public function __construct(
        CreateTournamentSimulationUseCase $createTournamentSimulationUseCase
    ) {
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

    public function store(StoreSimulationRequest $request)
    {
        $result = $this->createTournamentSimulationUseCase->execute();
        if (!$result) {
            throw new CustomJsonException(['message' => 'Error al crear la simulación.']);
        }
        return response()->json(['message' => 'Simulación creada correctamente.'], 201);
    }
}

