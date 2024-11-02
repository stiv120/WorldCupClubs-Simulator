<?php

namespace Src\Import\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Import\Domain\Repositories\ImportRepositoryInterface;
use Src\Import\Infrastructure\Persistence\EloquentImportRepository;

/**
 * Proveedor de servicios para el módulo de importación
 * @package Src\Import\Infrastructure\Providers
 */
class ImportServiceProvider extends ServiceProvider
{
    /**
     * Registra los bindings en el contenedor
     * @return void
     */
    public function register()
    {
        $this->app->bind(ImportRepositoryInterface::class, function ($app) {
            return $app->make(EloquentImportRepository::class);
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
