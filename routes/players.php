<?php

use Illuminate\Support\Facades\Route;
use Src\Player\Infrastructure\Controllers\PlayerController;

/**
 * Muestra la vista principal de jugadores
 * @route GET /players
 * @name players.index
 */
Route::get("/", [PlayerController::class, "index"])->name("index");

/**
 * Obtiene la lista de jugadores para actualizar la tabla
 * @route GET /players/cargar
 * @name players.list
 * @return \Illuminate\Http\Response HTML parcial con la lista de jugadores
 */
Route::get("/cargar", [PlayerController::class, "getplayersList"])->name("list");

/**
 * Almacena un nuevo jugador
 * @route POST /players/guardar
 * @name players.store
 * @param \Illuminate\Http\Request $request
 * @return \Illuminate\Http\JsonResponse
 */
Route::post("guardar", [PlayerController::class, "store"])->name("store");
