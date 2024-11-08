<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('web')
                ->prefix('equipos')
                ->as('teams.')
                ->group(base_path('routes/teams.php'));

            Route::middleware('web')
                ->prefix('jugadores')
                ->as('players.')
                ->group(base_path('routes/players.php'));

            Route::middleware('web')
                ->prefix('simulaciones')
                ->as('simulations.')
                ->group(base_path('routes/simulations.php'));

            Route::middleware('web')
                ->prefix('importaciones')
                ->as('imports.')
                ->group(base_path('routes/imports.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
