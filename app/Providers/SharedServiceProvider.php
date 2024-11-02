<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Shared\Domain\Services\FileStorageService;
use Src\Shared\Infrastructure\Services\LaravelFileStorageService;

class SharedServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(FileStorageService::class, LaravelFileStorageService::class);
    }
}
