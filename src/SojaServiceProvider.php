<?php

namespace WebId\Soja;

use Illuminate\Support\ServiceProvider;

class SojaServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/soja.php', 'soja');
    }
}
