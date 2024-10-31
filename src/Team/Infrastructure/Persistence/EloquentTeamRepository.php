<?php

namespace Src\Team\Infrastructure\Persistence;

use Src\Team\Domain\Entities\Team;
use App\Models\Team as EloquentTeam;
use Src\Team\Domain\Repositories\TeamRepositoryInterface;

class EloquentTeamRepository implements TeamRepositoryInterface
{
    /**
     * Save a new team to the database.
     * @param Team $team
     * @return bool
     */
    public function save(Team $team)
    {
        $eloquentTeam = new EloquentTeam();
        $eloquentTeam->pais = $team->getPais();
        $eloquentTeam->nombre = $team->getNombre();
        $eloquentTeam->url_bandera = $team->getUrlBandera();
        return $eloquentTeam->save();
    }
}



