<?php

namespace Src\Team\Infrastructure\Persistence;

use Src\Team\Domain\Entities\Team;
use App\Models\Team as EloquentTeam;
use Src\Team\Domain\Repositories\TeamRepositoryInterface;

/**
 * Implementación Eloquent del repositorio de Equipos
 * Esta clase proporciona la implementación concreta del repositorio
 * utilizando Eloquent como ORM para la persistencia de datos.
 * @package Src\Team\Infrastructure\Persistence
 */
class EloquentTeamRepository implements TeamRepositoryInterface
{
    /**
     * Guarda un nuevo equipo en la base de datos
     * @param Team $team Entidad del equipo a guardar
     * @return bool Verdadero si se guardó correctamente, falso en caso contrario
     * @throws \Exception Si hay un error al guardar en la base de datos
     */
    public function save(Team $team)
    {
        $eloquentTeam = new EloquentTeam();
        $eloquentTeam->pais = $team->getPais();
        $eloquentTeam->nombre = $team->getNombre();
        $eloquentTeam->url_bandera = $team->getUrlBandera();
        return $eloquentTeam->save();
    }

    /**
     * Obtiene todos los equipos de la base de datos
     * @return \Illuminate\Database\Eloquent\Collection Colección de equipos
     * @throws \Exception Si hay un error al consultar la base de datos
     */
    public function findAll()
    {
        return EloquentTeam::all();
    }
}



