<?php

namespace Src\Simulation\Domain\Repositories;

use Src\Simulation\Domain\Entities\MatchGame;

interface MatchWinnerDeterminerInterface
{
    public function determineWinner(MatchGame $match): int;
}
