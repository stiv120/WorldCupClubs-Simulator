<?php

namespace Src\Simulation\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Simulation\Domain\Repositories\ResultRepositoryInterface;
use Src\Simulation\Domain\Repositories\MatchGameRepositoryInterface;
use Src\Simulation\Domain\Repositories\SimulationRepositoryInterface;
use Src\Simulation\Domain\Repositories\MatchWinnerDeterminerInterface;
use Src\Simulation\Domain\Repositories\TeamStatsUpdaterInterface;
use Src\Simulation\Infrastructure\Persistence\EloquentResultRepository;
use Src\Simulation\Infrastructure\Persistence\EloquentMatchGameRepository;
use Src\Simulation\Infrastructure\Persistence\EloquentMatchWinnerDeterminer;
use Src\Simulation\Infrastructure\Persistence\EloquentSimulationRepository;
use Src\Simulation\Infrastructure\Persistence\EloquentTeamStatsUpdater;

/**
 * Proveedor de servicios para el módulo de Jugadores
 * @package Src\Player\Infrastructure\Providers
 */
class SimulationServiceProvider extends ServiceProvider
{
    /**
     * Registra los bindings en el contenedor de inyección de dependencias
     * @return void
     */
    public function register()
    {
        $this->app->bind(SimulationRepositoryInterface::class, function ($app) {
            return $app->make(EloquentSimulationRepository::class);
        });
        $this->app->bind(MatchGameRepositoryInterface::class, function ($app) {
            return $app->make(EloquentMatchGameRepository::class);
        });
        $this->app->bind(ResultRepositoryInterface::class, function ($app) {
            return $app->make(EloquentResultRepository::class);
        });
        $this->app->bind(MatchWinnerDeterminerInterface::class, function ($app) {
            return $app->make(EloquentMatchWinnerDeterminer::class);
        });
        $this->app->bind(TeamStatsUpdaterInterface::class, function ($app) {
            return $app->make(EloquentTeamStatsUpdater::class);
        });

    }

    /**
     * Inicializa los servicios del módulo de jugadores
     * @return void
     */
    public function boot()
    {
        //
    }
}
