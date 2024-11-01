<?php

namespace Src\Team\Domain\Repositories;

use Src\Team\Domain\Entities\Team;

/**
 * Interfaz para el repositorio de Equipos
 * @package Src\Team\Domain\Repositories
 */
interface TeamRepositoryInterface
{
    /**
     * Guarda un nuevo equipo
     * @param Team $team Equipo a guardar
     * @return bool
     */
    public function save(Team $team);

    /**
     * Obtiene todos los equipos
     * @return array
     */
    public function findAll();

    /**
     * Obtiene la cantidad de equipos
     * @return int
     */
    public function count();

    /**
     * Obtiene la cantidad de equipos con jugadores válidos
     * @return int
     */
    public function validTeamsWithPlayers();
}


