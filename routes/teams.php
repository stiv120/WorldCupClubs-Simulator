<?php

use Illuminate\Support\Facades\Route;
use Src\Team\Infrastructure\Controllers\TeamController;

Route::get('/', [TeamController::class, 'index'])->name('index');
