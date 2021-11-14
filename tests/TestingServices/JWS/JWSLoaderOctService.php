<?php

namespace WebId\Soja\Tests\TestingServices\JWS;

use WebId\Soja\AbstractServices\JWS\JWSLoadingAbstract;
use Jose\Component\Checker\HeaderCheckerManager;
use Jose\Component\Core\AlgorithmManager;
use Jose\Component\Signature\Algorithm\HS256;
use Jose\Component\Signature\JWSTokenSupport;
use Jose\Component\Signature\Serializer\CompactSerializer;
use Jose\Component\Checker\AlgorithmChecker;

class JWSLoaderOctService extends JWSLoadingAbstract
{
    function getAlgorithmManager(): AlgorithmManager
    {
        return new AlgorithmManager([
            new HS256(),
        ]);
    }

    function getSerializer(): CompactSerializer
    {
        return new CompactSerializer();
    }

    function getHeaderCheckerManager(): ?HeaderCheckerManager
    {
        return new HeaderCheckerManager(
            [new AlgorithmChecker(['HS256'])],
            [new JWSTokenSupport()]
        );
    }
}
