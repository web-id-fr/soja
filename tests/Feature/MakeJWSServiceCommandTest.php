<?php

namespace WebId\Soja\Tests\Feature;

use WebId\Soja\Console\Commands\MakeJWSServiceCommand;
use WebId\Soja\Tests\TestCase;

class MakeJWSServiceCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->deleteTrashFolder();
    }

    /** @test */
    public function it_can_use_only_creator_service_option(): void
    {
        $this->artisan('make:jws')
            ->expectsQuestion('Which service do you want ?', [MakeJWSServiceCommand::CREATE_TOKEN_CHOICE])
            ->expectsQuestion('Which algorithm do you use ?', 'HS256')
            ->expectsQuestion('Which serializer do you use ?', 'JWS Compact')
            ->assertExitCode(1);

        $this->assertFileExistsOnTrashFolder('Services/JWSCreatorHS256Service.php');
    }

    /** @test */
    public function it_can_use_only_loader_service_option(): void
    {
        $this->artisan('make:jws')
            ->expectsQuestion('Which service do you want ?', [MakeJWSServiceCommand::LOAD_TOKEN_CHOICE])
            ->expectsQuestion('Which algorithm do you use ?', 'HS256')
            ->expectsQuestion('Which serializer do you use ?', 'JWS Compact')
            ->expectsQuestion('Would you use HeaderChecker ?', true)
            ->assertExitCode(1);

        $this->assertFileExistsOnTrashFolder('Services/JWSLoaderHS256Service.php');
    }

    /** @test */
    public function it_can_use_only_loader_service_option_without_header_checker(): void
    {
        $this->artisan('make:jws')
            ->expectsQuestion('Which service do you want ?', [MakeJWSServiceCommand::LOAD_TOKEN_CHOICE])
            ->expectsQuestion('Which algorithm do you use ?', 'HS256')
            ->expectsQuestion('Which serializer do you use ?', 'JWS Compact')
            ->expectsQuestion('Would you use HeaderChecker ?', false)
            ->assertExitCode(1);

        $this->assertFileExistsOnTrashFolder('Services/JWSLoaderHS256WithoutHeaderCheckerService.php');
    }

    /** @test */
    public function it_can_use_both_creator_service_and_loader_service(): void
    {
        $this->artisan('make:jws')
            ->expectsQuestion('Which service do you want ?', [
                MakeJWSServiceCommand::CREATE_TOKEN_CHOICE,
                MakeJWSServiceCommand::LOAD_TOKEN_CHOICE
            ])
            ->expectsQuestion('Which algorithm do you use ?', 'HS256')
            ->expectsQuestion('Which serializer do you use ?', 'JWS Compact')
            ->expectsQuestion('Would you use HeaderChecker ?', false)
            ->assertExitCode(1);

        $this->assertFileExistsOnTrashFolder('Services/JWSCreatorHS256Service.php');
        $this->assertFileExistsOnTrashFolder('Services/JWSLoaderHS256WithoutHeaderCheckerService.php');
    }
}
