<?php

namespace Src\Team\Application\UseCases;

use Src\Team\Domain\Entities\Team;
use Src\Team\Domain\Repositories\TeamRepositoryInterface;

class RegisterTeamUseCase
{
    private $teamRepository;

    public function __construct(TeamRepositoryInterface $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    public function execute(array $data)
    {
        $team = new Team($data);
        return $this->teamRepository->save($team);
    }
}
