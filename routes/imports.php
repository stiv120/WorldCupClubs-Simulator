<?php

use Illuminate\Support\Facades\Route;
use Src\Import\Infrastructure\Controllers\ImportController;

Route::get('/', [ImportController::class, 'index'])->name('index');
Route::post('/guardar', [ImportController::class, 'store'])->name('store');
