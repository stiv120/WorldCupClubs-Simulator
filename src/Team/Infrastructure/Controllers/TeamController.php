<?php

namespace Src\Team\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use App\Exceptions\CustomJsonException;
use Src\Team\Application\UseCases\GetAllTeamsUseCase;
use Src\Team\Infrastructure\Request\StoreTeamRequest;
use Src\Team\Application\UseCases\RegisterTeamUseCase;

/**
 * Controlador para la gestión de Equipos
 * @package Src\Team\Infrastructure\Controllers
 */
class TeamController extends Controller
{
    /** @var GetAllTeamsUseCase */
    private $getAllTeamsUseCase;

    /** @var RegisterTeamUseCase */
    private $registerTeamUseCase;

    /**
     * Constructor del controlador
     * @param GetAllTeamsUseCase $getAllTeamsUseCase Caso de uso para obtener todos los equipos
     * @param RegisterTeamUseCase $registerTeamUseCase Caso de uso para registrar un nuevo equipo
     */
    public function __construct(
        GetAllTeamsUseCase $getAllTeamsUseCase,
        RegisterTeamUseCase $registerTeamUseCase
    ) {
        $this->getAllTeamsUseCase = $getAllTeamsUseCase;
        $this->registerTeamUseCase = $registerTeamUseCase;
    }

    /**
     * Muestra la vista principal con el listado de equipos
     * @return \Illuminate\View\View Vista con la lista de equipos
     */
    public function index()
    {
        $info['equipos'] = $this->getAllTeams();
        return view('teams/index', $info);
    }

    /**
     * Obtiene todos los equipos desde el caso de uso
     * @return array Lista de equipos
     */
    public function getAllTeams()
    {
        return $this->getAllTeamsUseCase->execute();
    }

    /**
     * Devuelve la vista parcial con la lista actualizada de equipos
     * @return \Illuminate\View\View Vista parcial con la lista de equipos
     */
    public function getTeamsList()
    {
        return view('teams/list', ['equipos' => $this->getAllTeams()]);
    }

    /**
     * Almacena un nuevo Equipo en la base de datos
     * @param StoreTeamRequest $request Request validado con los datos del equipo
     * @return \Illuminate\Http\JsonResponse Respuesta JSON con el resultado de la operación
     * @throws CustomJsonException Si hay un error durante el proceso de creación
     */
    public function store(StoreTeamRequest $request)
    {
        $storeTeam = $this->registerTeamUseCase->execute($request->all());

        if (!$storeTeam) {
            throw new CustomJsonException(['message' => 'Error al crear el Equipo.']);
        }

        return response()->json(['message' => 'Equipo creado correctamente.'], 201);
    }
}
