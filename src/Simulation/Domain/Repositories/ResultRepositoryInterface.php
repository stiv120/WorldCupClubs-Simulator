<?php

namespace Src\Simulation\Domain\Repositories;

use Src\Simulation\Domain\Entities\Result;

interface ResultRepositoryInterface
{
    public function save(Result $result): void;
    public function findBySimulationId(int $simulacionId): array;
    public function findByTeam(int $simulacionId, int $equipoId): ?Result;
    public function updateTeamStats(int $simulacionId, int $equipoId, array $stats): void;
    public function getWinner(int $simulacionId): ?Result;
    public function eliminateTeam(int $simulacionId, int $equipoId): void;
    public function setChampion(int $simulacionId, int $equipoId): void;
}
