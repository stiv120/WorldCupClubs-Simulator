<?php

namespace Src\Player\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use App\Exceptions\CustomJsonException;
use Src\Team\Application\UseCases\GetAllTeamsUseCase;
use Src\Player\Application\UseCases\GetAllPlayersUseCase;
use Src\Player\Infrastructure\Request\StorePlayerRequest;
use Src\Player\Application\UseCases\RegisterPlayerUseCase;

/**
 * Controlador para la gestión de Jugadores
 * @package Src\Player\Infrastructure\Controllers
 */
class PlayerController extends Controller
{
    /**
     * @var GetAllPlayersUseCase Caso de uso para listar jugadores
     */
    private $getAllPlayersUseCase;

    /**
     * @var RegisterPlayerUseCase Caso de uso para registro de jugadores
     */
    private $registerPlayerUseCase;

    /**
     * @var GetAllTeamsUseCase Caso de uso para listar equipos
     */
    private $getAllTeamsUseCase;

    /**
     * Constructor del controlador de jugadores
     * @param GetAllPlayersUseCase $getAllPlayersUseCase Caso de uso para obtener todos los jugadores
     * @param RegisterPlayerUseCase $registerPlayerUseCase Caso de uso para registrar un nuevo jugador
     * @param GetAllTeamsUseCase $getAllTeamsUseCase Caso de uso para obtener todos los equipos
     */
    public function __construct(
        GetAllPlayersUseCase $getAllPlayersUseCase,
        RegisterPlayerUseCase $registerPlayerUseCase,
        GetAllTeamsUseCase $getAllTeamsUseCase
    ) {
        $this->getAllPlayersUseCase = $getAllPlayersUseCase;
        $this->registerPlayerUseCase = $registerPlayerUseCase;
        $this->getAllTeamsUseCase = $getAllTeamsUseCase;
    }

    /**
     * Muestra la vista principal con el listado de jugadores y equipos disponibles
     * @return \Illuminate\View\View Vista con la lista de jugadores y equipos
     */
    public function index()
    {
        $info['jugadores'] = $this->getAllPlayers();
        $info['equipos'] = $this->getAllTeamsUseCase->execute();
        return view('players/index', $info);
    }

    /**
     * Obtiene el listado completo de jugadores
     * @return array Lista de todos los jugadores registrados
     */
    public function getAllPlayers()
    {
        return $this->getAllPlayersUseCase->execute();
    }

    /**
     * Devuelve la vista parcial actualizada con la lista de jugadores
     * @return \Illuminate\View\View Vista parcial con la lista actualizada de jugadores
     */
    public function getPlayersList()
    {
        return view('players/list', ['jugadores' => $this->getAllPlayers()]);
    }

    /**
     * Registra un nuevo jugador en el sistema
     * @param StorePlayerRequest $request Request validado con los datos del nuevo jugador
     * @return \Illuminate\Http\JsonResponse Respuesta JSON con el resultado del registro
     * @throws CustomJsonException Si ocurre un error durante el registro del jugador
     */
    public function store(StorePlayerRequest $request)
    {
        $storePlayer = $this->registerPlayerUseCase->execute($request->all());

        if (!$storePlayer) {
            throw new CustomJsonException(['message' => 'Error al crear el jugador.']);
        }
        return response()->json(['message' => 'Jugador creado correctamente.'], 201);
    }
}
