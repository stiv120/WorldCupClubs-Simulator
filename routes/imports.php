<?php

use Illuminate\Support\Facades\Route;
use Src\Import\Infrastructure\Controllers\ImportController;

Route::get('/', [ImportController::class, 'index'])->name('index');
Route::post('/store', [ImportController::class, 'store'])->name('store');
