<?php

declare(strict_types=1);

namespace Prism\Core\Concerns;

use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

use function array_map;
use function dirname;
use function file_get_contents;
use function is_array;
use function is_dir;
use function is_file;
use function json_decode;
use function ltrim;
use function strlen;

trait IteratesFleet
{
    /**
     * @return array{paths: array<int, string>, error?: string}
     */
    private function loadFleet(string $fileOption, string $workingDirectory): array
    {
        $fleetPath = $this->resolveFleetPath($fileOption, $workingDirectory);

        if (! is_file($fleetPath)) {
            return ['paths' => [], 'error' => "Fleet file not found at {$fleetPath}"];
        }

        $decoded = json_decode((string) file_get_contents($fleetPath), true);

        if (! is_array($decoded)) {
            return ['paths' => [], 'error' => 'Invalid fleet.json: expected a JSON array of paths.'];
        }

        $baseDir = dirname($fleetPath);
        $paths = [];

        foreach ($decoded as $index => $path) {
            if (! is_string($path) || trim($path) === '') {
                return ['paths' => [], 'error' => "Invalid path at index {$index}; expected non-empty string."];
            }

            $paths[] = $this->resolveSitePath($path, $baseDir);
        }

        return ['paths' => $paths];
    }

    /**
     * @param array<int, string> $sites
     * @param callable(string $site): array{site:string,status:string,message:string} $callback
     * @return array{rows: array<int, array{site:string,status:string,message:string}>, failures:int}
     */
    private function processFleet(array $sites, callable $callback, ProgressBar $progressBar, bool $stopOnFailure = false): array
    {
        $rows = [];
        $failures = 0;

        foreach ($sites as $site) {
            $progressBar->setMessage("Processing {$site}");

            if (! is_dir($site)) {
                $rows[] = ['site' => $site, 'status' => 'Failure', 'message' => 'Path not found'];
                $failures++;
                $progressBar->advance();
                if ($stopOnFailure) {
                    break;
                }
                continue;
            }

            $result = $callback($site);
            $rows[] = $result;

            if ($result['status'] === 'Failure') {
                $failures++;
                $progressBar->advance();
                if ($stopOnFailure) {
                    break;
                }
                continue;
            }

            $progressBar->advance();
        }

        return ['rows' => $rows, 'failures' => $failures];
    }

    /**
     * @param array<int, string> $command
     * @return array{status:string,message:string}
     */
    private function runProcess(array $command, string $cwd): array
    {
        $process = new Process($command, $cwd);
        $process->setTimeout(300);

        try {
            $process->run();
        } catch (ProcessFailedException $exception) {
            return ['status' => 'Failure', 'message' => $exception->getMessage()];
        }

        if (! $process->isSuccessful()) {
            return ['status' => 'Failure', 'message' => trim($process->getErrorOutput() ?: $process->getOutput()) ?: 'Command failed'];
        }

        return ['status' => 'Success', 'message' => ''];
    }

    private function resolveFleetPath(string $option, string $workingDirectory): string
    {
        if ($this->isAbsolutePath($option)) {
            return $option;
        }

        return $workingDirectory . DIRECTORY_SEPARATOR . $option;
    }

    private function resolveSitePath(string $path, string $baseDir): string
    {
        if ($this->isAbsolutePath($path)) {
            return $path;
        }

        return $baseDir . DIRECTORY_SEPARATOR . ltrim($path, DIRECTORY_SEPARATOR);
    }

    private function isAbsolutePath(string $path): bool
    {
        return Str::startsWith($path, ['/', '\\'])
            || (strlen($path) > 1 && ctype_alpha($path[0]) && $path[1] === ':');
    }
}

