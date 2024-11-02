<?php

namespace Src\Team\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Team\Domain\Repositories\TeamRepositoryInterface;
use Src\Team\Infrastructure\Persistence\EloquentTeamRepository;

/**
 * Proveedor de servicios para el módulo de Equipos
 * @package Src\Team\Infrastructure\Providers
 */
class TeamServiceProvider extends ServiceProvider
{
    /**
     * Registra los bindings en el contenedor
     * @return void
     */
    public function register()
    {
        $this->app->bind(TeamRepositoryInterface::class, function ($app) {
            return $app->make(EloquentTeamRepository::class);
        });
    }

    /**
     * Invocar cualquier servicio de la aplicación
     * @return void
     */
    public function boot()
    {
        //
    }
}
