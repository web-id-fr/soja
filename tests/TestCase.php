<?php

namespace WebId\Soja\Tests;

use Illuminate\Support\Facades\File;
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

    protected function getEnvironmentSetUp($app): void
    {
        config()->set('soja.driver', 'testing');
    }

    protected function deleteTrashFolder(): void
    {
        File::deleteDirectory(__DIR__ . '/trash');
    }
    protected function assertFileExistsOnTrashFolder(string $filePath): void
    {
        $this->assertFileExists(__DIR__ . '/trash/' . $filePath);
    }

}
