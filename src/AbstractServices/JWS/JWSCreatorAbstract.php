<?php

namespace WebId\Soja\AbstractServices\JWS;

use Jose\Component\Core\AlgorithmManager;
use Jose\Component\Core\JWK;
use Jose\Component\Signature\JWSBuilder;
use Jose\Component\Signature\Serializer\Serializer;

abstract class JWSCreatorAbstract
{
    abstract function getAlgorithmManager(): AlgorithmManager;

    abstract function getSerializer(): Serializer;

    /**
     * @param JWK $jwk
     * @param array<mixed> $payload
     * @return string
     * @throws \Exception
     */
    public function createToken(JWK $jwk, array $payload): string
    {
        $signatureAlgorithm = $this->getAlgorithmManager()->list()[0];
        $builder = new JWSBuilder($this->getAlgorithmManager());

        if (!$payloadEncoded = json_encode($payload)) {
            throw new \Exception('Error while json encoding the payload.');
        }

        $jws = $builder
            ->create()
            ->withPayload($payloadEncoded)
            ->addSignature($jwk, ['alg' => $signatureAlgorithm])
            ->build();

        $serializer = $this->getSerializer();

        return $serializer->serialize($jws, 0);
    }
}
