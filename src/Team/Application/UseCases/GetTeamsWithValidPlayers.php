<?php

namespace Src\Team\Application\UseCases;

use Src\Team\Domain\Repositories\TeamRepositoryInterface;

/**
 * Caso de uso para obtener la cantidad de equipos
 * @package Src\Team\Application\UseCases
 */
class GetTeamsWithValidPlayers
{
    /**
     * Repositorio de equipos
     * @var TeamRepositoryInterface
     */
    private $teamRepository;

    /**
     * Constructor del caso de uso
     * @param TeamRepositoryInterface $teamRepository Repositorio para consulta de equipos
     */
    public function __construct(TeamRepositoryInterface $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    /**
     * Ejecuta el caso de uso para obtener la cantidad de equipos
     * @return int Cantidad de equipos
     */
    public function execute()
    {
        return $this->teamRepository->validTeamsWithPlayers();
    }
}
