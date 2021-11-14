<?php

namespace WebId\Soja\AbstractServices\JWS;

use Jose\Component\Checker\HeaderCheckerManager;
use Jose\Component\Core\AlgorithmManager;
use Jose\Component\Core\JWK;
use Jose\Component\Signature\JWSLoader;
use Jose\Component\Signature\JWSVerifier;
use Jose\Component\Signature\Serializer\JWSSerializerManager;
use Jose\Component\Signature\Serializer\Serializer;

abstract class JWSLoadingAbstract
{
    abstract function getAlgorithmManager(): AlgorithmManager;

    abstract function getSerializer(): Serializer;

    abstract function getHeaderCheckerManager(): ?HeaderCheckerManager;

    /**
     * @param JWK $jwk
     * @param string $token
     * @return array<mixed>
     * @throws \Exception
     */
    public function loadToken(JWK $jwk, string $token): array
    {
        $verifier = new JWSVerifier($this->getAlgorithmManager());

        $serializerManager = new JWSSerializerManager([
            $this->getSerializer()
        ]);

        $loader = new JWSLoader(
            $serializerManager,
            $verifier,
            $this->getHeaderCheckerManager()
        );

        $jws = $loader->loadAndVerifyWithKey($token, $jwk, $signature);

        if (is_null($jws->getPayload())) {
            return [];
        }

        if (!$payload = json_decode($jws->getPayload())) {
            throw new \Exception('Error while json decoding the payload.');
        }

        return (array) $payload;
    }
}
