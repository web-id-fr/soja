<?php

namespace WebId\Soja\Tests\TestingServices\JWS;

use Jose\Component\Checker\HeaderCheckerManager;
use Jose\Component\Core\AlgorithmManager;
use Jose\Component\Signature\Algorithm\HS256;
use Jose\Component\Signature\Serializer\CompactSerializer;
use WebId\Soja\AbstractServices\JWS\JWSLoadingAbstract;

class JWSLoaderOctWithoutHeaderCheckerService extends JWSLoadingAbstract
{
    public function getAlgorithmManager(): AlgorithmManager
    {
        return new AlgorithmManager([
            new HS256(),
        ]);
    }

    public function getSerializer(): CompactSerializer
    {
        return new CompactSerializer();
    }

    public function getHeaderCheckerManager(): ?HeaderCheckerManager
    {
        return null;
    }
}
