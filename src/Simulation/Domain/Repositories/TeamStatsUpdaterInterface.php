<?php

namespace Src\Simulation\Domain\Repositories;

use Src\Simulation\Domain\Entities\MatchGame;

interface TeamStatsUpdaterInterface
{
    public function updateStats(MatchGame $match, int $winnerId): void;
}
