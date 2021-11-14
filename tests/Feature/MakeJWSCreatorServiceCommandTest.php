<?php

namespace WebId\Soja\Tests\Feature;

use WebId\Soja\Tests\TestCase;

class MakeJWSCreatorServiceCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->deleteTrashFolder();
    }

    /** @test */
    public function it_can_make_jwt_creator_service(): void
    {
        $this->artisan('make:jws:creator JWSCreatorHS256Service HS256 jws_compact');

        $this->assertFileExistsOnTrashFolder('Services/JWSCreatorHS256Service.php');
    }
}
