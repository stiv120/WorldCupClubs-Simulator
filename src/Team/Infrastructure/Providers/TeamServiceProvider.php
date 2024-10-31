<?php

namespace Src\Team\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Team\Domain\Repositories\TeamRepositoryInterface;
use Src\Team\Infrastructure\Persistence\EloquentTeamRepository;

class TeamServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(TeamRepositoryInterface::class, function ($app) {
            return $app->make(EloquentTeamRepository::class);
        });
    }

    public function boot()
    {
        //
    }
}
