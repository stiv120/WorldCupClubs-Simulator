<?php

use Illuminate\Support\Facades\Route;
use Src\Simulation\Infrastructure\Controllers\SimulationController;

Route::get('/', [SimulationController::class, 'index'])->name('index');
Route::post('/store', [SimulationController::class, 'store'])->name('store');
// Route::get('/list', [SimulationController::class, 'list'])->name('simulations.list');
// Route::get('/{id}', [SimulationController::class, 'show'])->name('simulations.show');
// Route::get('/champion', [SimulationController::class, 'getChampion'])->name('simulations.champion');
// Route::get('/stats/{equipoId}', [SimulationController::class, 'getTeamStats'])->name('simulations.stats');
