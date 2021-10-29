<?php

namespace WebId\Soja\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use WebId\Soja\SojaServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            SojaServiceProvider::class,
        ];
    }
}
