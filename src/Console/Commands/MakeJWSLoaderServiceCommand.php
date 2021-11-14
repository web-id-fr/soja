<?php

namespace WebId\Soja\Console\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MakeJWSLoaderServiceCommand extends GeneratorCommand
{
    /** @var string */
    protected $name = 'make:jws:loader';

    /** @var string */
    protected $description = 'Create a new JWSLoader class';

    /** @var string */
    protected $type = 'Service';

    protected function getStub(): string
    {
        return $this->resolveStubPath(
            $this->option('withoutHeaderChecker')
                ? 'JWS/jws.loader.withoutHeaderChecker.stub'
                : 'JWS/jws.loader.stub'
        );
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\\Services';
    }

    protected function buildClass($name): string
    {
        $stub = $this->files->get($this->getStub());

        return $this
            ->replaceNamespace($stub, $name)
            ->replaceNamespaceAlgorithm($stub)
            ->replaceAlgorithm($stub)
            ->replaceNamespaceSerializer($stub)
            ->replaceSerializer($stub)
            ->replaceClass($stub, $name);
    }

    protected function replaceNamespaceAlgorithm(string &$stub): self
    {
        $algorithms = collect(config('soja.jws.algorithms', []))->mapWithKeys(function ($algorithmClass) {
            return [app($algorithmClass)->name() => $algorithmClass];
        })->toArray();

        $stub = str_replace([
            'DummyAlgorithmNamespace',
            '{{ algorithmNamespace }}',
            '{{algorithmNamespace}}',
        ], data_get($algorithms, $this->argument('algorithmClass')), $stub);

        return $this;
    }

    protected function replaceAlgorithm(string &$stub): self
    {
        /** @var string $algorithmClass */
        $algorithmClass = $this->argument('algorithmClass');
        $stub = str_replace([
            'DummyAlgorithm',
            '{{ algorithm }}',
            '{{algorithm}}',
        ], $algorithmClass, $stub);

        return $this;
    }

    protected function replaceNamespaceSerializer(string &$stub): self
    {
        $serializers = collect(config('soja.jws.serializers', []))->mapWithKeys(function ($serializerClass) {
            return [app($serializerClass)->name() => $serializerClass];
        })->toArray();

        $stub = str_replace([
            'DummySerializerNamespace',
            '{{ serializerNamespace }}',
            '{{serializerNamespace}}',
        ], data_get($serializers, $this->argument('serializerClass')), $stub);

        return $this;
    }

    protected function replaceSerializer(string &$stub): self
    {
        $serializers = collect(config('soja.jws.serializers', []))->mapWithKeys(function ($serializerClass) {
            return [app($serializerClass)->name() => $serializerClass];
        })->toArray();

        $stub = str_replace([
            'DummySerializer',
            '{{ serializer }}',
            '{{serializer}}',
        ], class_basename(data_get($serializers, $this->argument('serializerClass'))), $stub);

        return $this;
    }

    /**
     * @return array[]
     */
    protected function getOptions(): array
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'Create the class even if the service already exists'],
            ['withoutHeaderChecker', null, InputOption::VALUE_NONE, 'Loader without HeaderChecker'],
        ];
    }

    /**
     * @return array[]
     */
    protected function getArguments(): array
    {
        return [
            ['name', null, InputArgument::REQUIRED, 'Class name'],
            ['algorithmClass', null, InputArgument::REQUIRED, 'Algorithm class used'],
            ['serializerClass', null, InputArgument::REQUIRED, 'Serializer class used'],
        ];
    }
}
