<?php

namespace WebId\Soja\Console\Commands;

use Illuminate\Console\GeneratorCommand as OriginalGeneratorCommand;
use Illuminate\Support\Str;

abstract class GeneratorCommand extends OriginalGeneratorCommand
{
    protected function resolveStubPath(string $stub): string
    {
        $customPath = config('soja.driver') === 'testing'
            ? __DIR__ . '/../../../tests/trash/' . $stub
            : $this->laravel->basePath("stubs/vendor/soja/" . $stub);

        return file_exists($customPath)
            ? $customPath
            : __DIR__ . "/../../Stubs/" . $stub;
    }

    protected function getPath($name): string
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return config('soja.driver') === 'testing'
            ? __DIR__ . '/../../../tests/trash/' . str_replace('\\', '/', $name).'.php'
            : $this->laravel['path'].'/'.str_replace('\\', '/', $name).'.php';
    }
}
