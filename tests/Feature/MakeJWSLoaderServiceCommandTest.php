<?php

namespace WebId\Soja\Tests\Feature;

use WebId\Soja\Tests\TestCase;

class MakeJWSLoaderServiceCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->deleteTrashFolder();
    }

    /** @test */
    public function it_can_make_jws_loader_service(): void
    {
        $this->artisan('make:jws:loader JWSLoaderHS256Service HS256 jws_compact');

        $this->assertFileExistsOnTrashFolder('Services/JWSLoaderHS256Service.php');
    }

    /** @test */
    public function it_can_make_jws_loader_service_without_header(): void
    {
        $this->artisan('make:jws:loader JWSLoaderHS256WithoutHeaderService HS256 jws_compact --withoutHeaderChecker');

        $this->assertFileExistsOnTrashFolder('Services/JWSLoaderHS256WithoutHeaderService.php');
    }
}
