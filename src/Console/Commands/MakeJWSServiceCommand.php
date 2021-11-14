<?php

namespace WebId\Soja\Console\Commands;

use Illuminate\Console\Command;

class MakeJWSServiceCommand extends Command
{
    const CREATE_TOKEN_CHOICE = 'JWS Creator (create token)';
    const LOAD_TOKEN_CHOICE = 'JWS Loader (decrypt token)';

    /** @var string */
    protected $name = 'make:jws';

    /** @var string */
    protected $description = 'Create a new JWS service class';

    public function handle(): bool
    {
        /** @var array<string> $choices */
        $choices = $this->choice(
            'Which service do you want ?',
            [
                self::CREATE_TOKEN_CHOICE,
                self::LOAD_TOKEN_CHOICE,
            ],
            self::LOAD_TOKEN_CHOICE,
            null,
            true
        );

        $algorithm = $this->getAlgorithm();
        $serializer = $this->getSerializer();

        if (in_array(self::CREATE_TOKEN_CHOICE, $choices)) {
            $this->call('make:jws:creator', [
                'name' => 'JWSCreator' . $algorithm . 'Service',
                'algorithmClass' => $algorithm,
                'serializerClass' => $serializer,
            ]);
        }

        if (in_array(self::LOAD_TOKEN_CHOICE, $choices)) {
            $useHeaderChecker = $this->confirm('Would you use HeaderChecker ?', true);
            $name = 'JWSLoader' . $algorithm . ($useHeaderChecker ? '' : 'WithoutHeaderChecker') . 'Service';

            $this->call('make:jws:loader', [
                'name' => $name,
                'algorithmClass' => $algorithm,
                'serializerClass' => $serializer,
                '--withoutHeaderChecker' => $useHeaderChecker,
            ]);
        }

        return true;
    }

    private function getAlgorithm(): string
    {
        $algorithms = collect(config('soja.jws.algorithms', []))->mapWithKeys(function ($algorithmClass) {
            return [app($algorithmClass)->name() => $algorithmClass];
        })->toArray();

        /** @var string $choice */
        $choice = $this->choice('Which algorithm do you use ?', array_keys($algorithms));

        return $choice;
    }

    private function getSerializer(): string
    {
        $serializers = collect(config('soja.jws.serializers', []))->mapWithKeys(function ($serializerClass) {
            return [app($serializerClass)->displayName() => app($serializerClass)->name()];
        })->toArray();

        /** @var string $choice */
        $choice = $this->choice('Which serializer do you use ?', array_keys($serializers));

        return $serializers[$choice];
    }
}
