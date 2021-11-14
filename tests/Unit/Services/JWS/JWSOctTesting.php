<?php

namespace WebId\Soja\Tests\Unit\Services\JWS;

use WebId\Soja\Tests\Helpers\JWKCreator;
use WebId\Soja\Tests\TestCase;
use WebId\Soja\Tests\TestingServices\JWS\JWSCreatorOctService;
use WebId\Soja\Tests\TestingServices\JWS\JWSLoaderOctService;
use WebId\Soja\Tests\TestingServices\JWS\JWSLoaderOctWithoutHeaderCheckerService;

class JWSOctTesting extends TestCase
{
    use JWKCreator;

    /** @test */
    public function it_can_create_and_decrypt_token_with_jwt_otc(): void
    {
        $jwk = $this->createJWKOct();
        $serviceCreator = new JWSCreatorOctService();
        $serviceLoader = new JWSLoaderOctService();
        $payload = [
            'iat' => time(),
            'nbf' => time(),
            'exp' => time() + 3600,
            'iss' => 'Test Iss',
            'aud' => 'Test Aud',
        ];

        $token = $serviceCreator->createToken($jwk, $payload);

        $this->assertCount(3, explode('.', $token));

        $this->assertEquals($payload, $serviceLoader->loadToken($jwk, $token));
    }

    /** @test */
    public function it_can_create_and_decrypt_token_without_header_check_with_jwt_otc(): void
    {
        $jwk = $this->createJWKOct();
        $serviceCreator = new JWSCreatorOctService();
        $serviceLoader = new JWSLoaderOctWithoutHeaderCheckerService();
        $payload = [
            'iat' => time(),
            'nbf' => time(),
            'exp' => time() + 3600,
            'iss' => 'Test Iss',
            'aud' => 'Test Aud',
        ];

        $token = $serviceCreator->createToken($jwk, $payload);

        $this->assertCount(3, explode('.', $token));

        $this->assertEquals($payload, $serviceLoader->loadToken($jwk, $token));
    }
}
