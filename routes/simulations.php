<?php

use Illuminate\Support\Facades\Route;
use Src\Simulation\Infrastructure\Controllers\SimulationController;

Route::get('/', [SimulationController::class, 'index'])->name('index');
Route::post('/guardar', [SimulationController::class, 'store'])->name('store');
Route::get('/resultados', [SimulationController::class, 'results'])->name('results');
