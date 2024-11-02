<?php

namespace Src\Player\Domain\Repositories;

use Src\Player\Domain\Entities\Player;

/**
 * Interfaz para el repositorio de Jugadores
 * @package Src\Player\Domain\Repositories
 */
interface PlayerRepositoryInterface
{
    /**
     * Guarda un nuevo jugador
     * @param Player $player Jugador a guardar
     * @return bool
     */
    public function save(Player $player);

    /**
     * Obtiene todos los jugadores
     * @return array
     */
    public function findAll();
}


