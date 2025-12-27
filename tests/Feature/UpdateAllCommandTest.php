<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Artisan;
use Illuminate\Filesystem\Filesystem;

it('simulates fleet updates in dry-run mode', function (): void {
    $filesystem = new Filesystem();
    $tempRoot = base_path('tests/tmp/update-all-command');

    $filesystem->deleteDirectory($tempRoot);
    $filesystem->ensureDirectoryExists($tempRoot . '/client-a');
    $filesystem->ensureDirectoryExists($tempRoot . '/client-b');

    file_put_contents($tempRoot . '/fleet.json', json_encode([
        'client-a',
        'client-b',
    ], JSON_PRETTY_PRINT));

    $originalCwd = getcwd();
    chdir($tempRoot);

    try {
        $exitCode = Artisan::call('update:all', [
            '--dry-run' => true,
            '--file' => 'fleet.json',
        ]);

        $output = Artisan::output();
    } finally {
        chdir($originalCwd ?: base_path());
        $filesystem->deleteDirectory($tempRoot);
    }

    expect($exitCode)->toBe(0);
    expect($output)->toContain('client-a');
    expect($output)->toContain('client-b');
    expect($output)->toContain('Dry run');
});

