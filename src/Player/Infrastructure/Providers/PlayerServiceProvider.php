<?php

namespace Src\Player\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Player\Domain\Repositories\PlayerRepositoryInterface;
use Src\Player\Infrastructure\Persistence\EloquentPlayerRepository;

/**
 * Proveedor de servicios para el módulo de Jugadores
 * @package Src\Player\Infrastructure\Providers
 */
class PlayerServiceProvider extends ServiceProvider
{
    /**
     * Registra los bindings en el contenedor de inyección de dependencias
     * @return void
     */
    public function register()
    {
        $this->app->bind(PlayerRepositoryInterface::class, function ($app) {
            return $app->make(EloquentPlayerRepository::class);
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
