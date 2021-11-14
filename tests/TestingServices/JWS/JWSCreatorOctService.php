<?php

namespace WebId\Soja\Tests\TestingServices\JWS;

use Jose\Component\Core\AlgorithmManager;
use Jose\Component\Signature\Algorithm\HS256;
use Jose\Component\Signature\Serializer\CompactSerializer;
use Jose\Component\Signature\Serializer\Serializer;
use WebId\Soja\AbstractServices\JWS\JWSCreatorAbstract;

class JWSCreatorOctService extends JWSCreatorAbstract
{
    public function getAlgorithmManager(): AlgorithmManager
    {
        return new AlgorithmManager([
            new HS256(),
        ]);
    }

    public function getSignatureAlgorithm(): string
    {
        return 'HS256';
    }

    public function getSerializer(): Serializer
    {
        return new CompactSerializer();
    }
}
