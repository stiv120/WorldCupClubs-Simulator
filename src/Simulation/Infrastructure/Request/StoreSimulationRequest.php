<?php

namespace Src\Simulation\Infrastructure\Request;

use App\Http\Requests\FormRequest;
use Src\Team\Application\UseCases\GetCountTeamsUseCase;
use Src\Team\Application\UseCases\GetTeamsWithValidPlayers;

/**
 * Request para validar la creación de una simulación
 */
class StoreSimulationRequest extends FormRequest
{
    private $getCountTeamsUseCase;
    private $getTeamsWithValidPlayers;

    public function __construct(
        GetCountTeamsUseCase $getCountTeamsUseCase,
        GetTeamsWithValidPlayers $getTeamsWithValidPlayers
    ) {
        $this->getCountTeamsUseCase = $getCountTeamsUseCase;
        $this->getTeamsWithValidPlayers = $getTeamsWithValidPlayers;
    }

    /**
     * Prepara y valida los datos antes de la simulación
     * @throws ValidationException
     */
    protected function prepareForValidation(): void
    {
        $teamsCount = $this->getCountTeamsUseCase->execute();
        $teamsWithValidPlayers = $this->getTeamsWithValidPlayers->execute();

        if ($teamsCount < 8) {
            $this->failedValidation(['message' => 'Se requieren al menos 8 equipos para iniciar el torneo.']);
        }

        if ($teamsCount % 2 !== 0) {
            $this->failedValidation(['message' => 'El número total de equipos debe ser par.']);
        }

        if ($teamsWithValidPlayers < $teamsCount) {
            $this->failedValidation(['message' => 'Todos los equipos deben tener minimo 11 jugadores y maximo 20 jugadores.']);
        }
    }
}
