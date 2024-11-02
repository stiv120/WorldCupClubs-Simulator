<?php

use Illuminate\Support\Facades\Route;
use Src\Team\Infrastructure\Controllers\TeamController;

/**
 * Muestra la vista principal de equipos
 * @route GET /teams
 * @name teams.index
 */
Route::get("/", [TeamController::class, "index"])->name("index");

/**
 * Obtiene la lista de equipos para actualizar la tabla
 * @route GET /teams/cargar
 * @name teams.list
 * @return \Illuminate\Http\Response HTML parcial con la lista de equipos
 */
Route::get("/cargar", [TeamController::class, "getTeamsList"])->name("list");

/**
 * Almacena un nuevo equipo
 * @route POST /teams/guardar
 * @name teams.store
 * @param \Illuminate\Http\Request $request
 * @return \Illuminate\Http\JsonResponse
 */
Route::post("guardar", [TeamController::class, "store"])->name("store");
