<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\SharedServiceProvider::class,
    Src\Team\Infrastructure\Providers\TeamServiceProvider::class,
    Src\Player\Infrastructure\Providers\PlayerServiceProvider::class,
    Src\Import\Infrastructure\Providers\ImportServiceProvider::class,
    Src\Simulation\Infrastructure\Providers\SimulationServiceProvider::class
];
