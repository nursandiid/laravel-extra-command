<?php

namespace Sandinur157\LaravelExtraCommand;

use App\Console\Commands\CreateInterfaceCommand;
use App\Console\Commands\CreateRepositoryCommand;
use Illuminate\Support\ServiceProvider;

class LaravelExtraCommandProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->commands([
            CreateRepositoryCommand::class,
            CreateInterfaceCommand::class
        ]);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
