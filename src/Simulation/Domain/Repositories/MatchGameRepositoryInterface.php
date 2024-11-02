<?php

namespace Src\Simulation\Domain\Repositories;

use Src\Simulation\Domain\Entities\MatchGame;

interface MatchGameRepositoryInterface
{
    public function save(MatchGame $match): void;
    public function findBySimulationId(int $simulacionId): array;
    public function findByTeam(int $simulacionId, int $equipoId): array;
    public function getLastMatchByTeam(int $simulacionId, int $equipoId): ?MatchGame;
}
