<?php

declare(strict_types=1);

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;

it('runs builds across fleet and reports failure', function (): void {
    $filesystem = new Filesystem();
    $tempRoot = base_path('tests/tmp/build-all-command');

    $filesystem->deleteDirectory($tempRoot);
    $filesystem->ensureDirectoryExists($tempRoot . '/client-success');
    $filesystem->ensureDirectoryExists($tempRoot . '/client-fail');

    file_put_contents($tempRoot . '/client-success/prism', "<?php echo 'ok'; exit(0);");
    file_put_contents($tempRoot . '/client-fail/prism', "<?php fwrite(STDERR, 'broken'); exit(1);");

    file_put_contents($tempRoot . '/fleet.json', json_encode([
        'client-success',
        'client-fail',
    ], JSON_PRETTY_PRINT));

    $originalCwd = getcwd();
    chdir($tempRoot);

    try {
        $exitCode = Artisan::call('build:all', [
            '--file' => 'fleet.json',
            '--stop-on-failure' => true,
        ]);

        $output = Artisan::output();
    } finally {
        chdir($originalCwd ?: base_path());
        $filesystem->deleteDirectory($tempRoot);
    }

    expect($exitCode)->toBe(1);
    expect($output)->toContain('client-success');
    expect($output)->toContain('client-fail');
    expect($output)->toContain('Failure');
});

