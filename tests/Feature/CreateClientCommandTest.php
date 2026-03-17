<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Process;
use Tests\Concerns\InteractsWithTemporaryClient;

uses(InteractsWithTemporaryClient::class);

beforeEach(function () {
    /** @var \Tests\TestCase&\Tests\Concerns\InteractsWithTemporaryClient $this */
    $this->setupTemporaryClient('cli-test');
});

afterEach(function () {
    /** @var \Tests\TestCase&\Tests\Concerns\InteractsWithTemporaryClient $this */
    $this->cleanupTemporaryClient();
});

it('can run create:client command with name argument', function () {
    /** @var \Tests\TestCase&\Tests\Concerns\InteractsWithTemporaryClient $this */
    Process::fake();

    $this->artisan('create:client test-client')
         ->expectsQuestion('Choose a theme preset', 'clinical')
         ->expectsQuestion('What is the primary brand color (hex)?', '#000000')
         ->expectsQuestion('Choose a compliance mode', 'supplements')
         ->assertExitCode(0);
});

it('initiates wizard if name argument is missing', function () {
    /** @var \Tests\TestCase&\Tests\Concerns\InteractsWithTemporaryClient $this */
    Process::fake();

    $this->artisan('create:client')
        ->expectsQuestion('What is the site title?', 'My New Site')
        ->expectsQuestion('Choose a theme preset', 'clinical')
        ->expectsQuestion('What is the primary brand color (hex)?', '#000000')
        ->expectsQuestion('Choose a compliance mode', 'supplements')
        ->assertExitCode(0);
});

it('scaffolds starter and runs installers', function () {
    /** @var \Tests\TestCase&\Tests\Concerns\InteractsWithTemporaryClient $this */
    Process::fake();

    $originalCwd = getcwd();
    chdir($this->tempRoot);

    try {
        $this->artisan('create:client MyClient')
            ->expectsQuestion('Choose a theme preset', 'clinical')
            ->expectsQuestion('What is the primary brand color (hex)?', '#000000')
            ->expectsQuestion('Choose a compliance mode', 'supplements')
            ->assertExitCode(0);
    } finally {
        chdir($originalCwd);
    }

    Process::assertRan(fn ($process) => str_contains($process->command, 'composer install'));
    Process::assertRan(fn ($process) => str_contains($process->command, 'npm install'));
});

it('populates config file', function () {
    /** @var \Tests\TestCase&\Tests\Concerns\InteractsWithTemporaryClient $this */
    Process::fake();

    $folderName = 'my-client-site';

    $originalCwd = getcwd();
    chdir($this->tempRoot);

    try {
        $this->artisan('create:client "My Client Site"')
             ->expectsQuestion('Choose a theme preset', 'clinical')
             ->expectsQuestion('What is the primary brand color (hex)?', '#ff0000')
             ->expectsQuestion('Choose a compliance mode', 'supplements')
             ->assertExitCode(0);

        $configFile = $folderName . '/config.php';
        expect(file_exists($configFile))->toBeTrue();
        $content = file_get_contents($configFile);

        expect($content)
            ->toContain("project_name: 'My Client Site'")
            ->toContain("theme_preset: 'clinical'")
            ->toContain("compliance_mode: 'supplements'")
            ->toContain("'primary' => '#ff0000'");

    } finally {
        chdir($originalCwd);
    }
});
