<?php

declare(strict_types=1);

test('strict types are declared in core PHP files', function () {
    $root = dirname(__DIR__, 2);

    $paths = [
        "{$root}/app",
        "{$root}/src",
        "{$root}/bootstrap",
        "{$root}/config",
        "{$root}/tests",
        "{$root}/prism",
    ];

    $targets = [];

    foreach ($paths as $path) {
        $normalizedPath = (string) realpath($path);

        if ($normalizedPath === '' || $normalizedPath === false) {
            continue;
        }

        if (is_file($normalizedPath)) {
            $targets[] = $normalizedPath;
            continue;
        }

        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($normalizedPath));

        foreach ($iterator as $file) {
            if ($file->isDir()) {
                continue;
            }

            $pathname = $file->getPathname();

            if (str_contains($pathname, DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . 'tmp' . DIRECTORY_SEPARATOR)) {
                // Skip generated temp fixtures used in integration tests
                continue;
            }

            if ($file->getExtension() === 'php' || $file->getFilename() === 'prism') {
                $targets[] = $pathname;
            }
        }
    }

    foreach ($targets as $file) {
        $contents = file_get_contents($file);
        expect(str_contains($contents, 'declare(strict_types=1);'))
            ->toBeTrue();
    }
});

