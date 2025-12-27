<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Process;
use Tests\Concerns\InteractsWithTemporaryClient;

uses(InteractsWithTemporaryClient::class);

beforeEach(function () {
    $this->setupTemporaryClient('cli-test');
});

afterEach(function () {
    $this->cleanupTemporaryClient();
});

it('can run create:client command with name argument', function () {
    Process::fake();

    $this->artisan('create:client test-client')
         ->expectsQuestion('Choose a niche', 'Clinical')
         ->expectsQuestion('What is the primary brand color (hex)?', '#000000')
         ->assertExitCode(0);
});

it('initiates wizard if name argument is missing', function () {
    Process::fake();

    $this->artisan('create:client')
        ->expectsQuestion('What is the site title?', 'My New Site')
        ->expectsQuestion('Choose a niche', 'Clinical')
        ->expectsQuestion('What is the primary brand color (hex)?', '#000000')
        ->assertExitCode(0);
});

it('clones repository and runs installers', function () {
    Process::fake();

    $this->artisan('create:client MyClient')
         ->expectsQuestion('Choose a niche', 'Clinical')
         ->expectsQuestion('What is the primary brand color (hex)?', '#000000')
         ->assertExitCode(0);

    Process::assertRan(fn ($process) => str_contains($process->command, 'git clone'));
    Process::assertRan(fn ($process) => str_contains($process->command, 'composer install'));
    Process::assertRan(fn ($process) => str_contains($process->command, 'npm install'));
});

it('populates config file', function () {
    Process::fake();

    $folderName = 'my-client-site';
    $this->filesystem->makeDirectory($this->tempRoot . '/' . $folderName);

    $originalCwd = getcwd();
    chdir($this->tempRoot);

    try {
        $this->artisan('create:client "My Client Site"')
             ->expectsQuestion('Choose a niche', 'Clinical')
             ->expectsQuestion('What is the primary brand color (hex)?', '#ff0000')
             ->assertExitCode(0);

        $configFile = $folderName . '/config.php';
        expect(file_exists($configFile))->toBeTrue();
        $content = file_get_contents($configFile);

        expect($content)
            ->toContain("'project_name' => 'My Client Site'")
            ->toContain("'theme_preset' => 'clinical'")
            ->toContain("'compliance_mode' => 'supplements'")
            ->toContain("'primary' => '#ff0000'");

    } finally {
        chdir($originalCwd);
    }
});
