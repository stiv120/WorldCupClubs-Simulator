<?php

namespace Src\Player\Application\UseCases;

use Src\Player\Domain\Repositories\PlayerRepositoryInterface;

/**
 * Caso de uso para obtener todos los jugadores
 * @package Src\Player\Application\UseCases
 */
class GetAllPlayersUseCase
{
    /**
     * Repositorio de jugadores
     * @var PlayerRepositoryInterface
     */
    private $playerRepository;

    /**
     * Constructor del caso de uso
     * @param PlayerRepositoryInterface $playerRepository Repositorio para consulta de jugadores
     */
    public function __construct(PlayerRepositoryInterface $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    /**
     * Ejecuta el caso de uso para obtener todos los jugadores
     * @return array Lista de todos los jugadores
     */
    public function execute()
    {
        return $this->playerRepository->findAll();
    }
}
