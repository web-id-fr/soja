<?php

namespace WebId\Soja;

use Illuminate\Support\ServiceProvider;
use WebId\Soja\Console\Commands\MakeJWSCreatorServiceCommand;
use WebId\Soja\Console\Commands\MakeJWSLoaderServiceCommand;
use WebId\Soja\Console\Commands\MakeJWSServiceCommand;

class SojaServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeJWSServiceCommand::class,
                MakeJWSCreatorServiceCommand::class,
                MakeJWSLoaderServiceCommand::class
            ]);
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/soja.php', 'soja');
    }
}
