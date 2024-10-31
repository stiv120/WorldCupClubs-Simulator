<?php

namespace Src\Team\Domain\Repositories;

use Src\Team\Domain\Entities\Team;

interface TeamRepositoryInterface
{
    public function save(Team $team);
}


