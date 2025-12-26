<?php

declare(strict_types=1);

namespace Prism\Core\Commands;

use LaravelZero\Framework\Commands\Command;
use Symfony\Component\Process\Process;

use function base_path;

class BuildCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'build {env=local : Target environment (e.g. local, production)}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Run the Prism static site build using Jigsaw.';

    public function handle(): int
    {
        $environment = (string) $this->argument('env');
        $workingDirectory = getcwd() ?: base_path();

        $sourcePath = $workingDirectory . DIRECTORY_SEPARATOR . 'source';
        if (! is_dir($sourcePath)) {
            $this->error("Missing source directory at {$sourcePath}. Ensure you run this from the client root.");

            return self::FAILURE;
        }

        $jigsawScript = $workingDirectory . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'tightenco' . DIRECTORY_SEPARATOR . 'jigsaw' . DIRECTORY_SEPARATOR . 'jigsaw';
        $engineScript = base_path('vendor/tightenco/jigsaw/jigsaw');
        $scriptToUse = is_file($jigsawScript) ? $jigsawScript : $engineScript;

        if (! is_file($scriptToUse)) {
            $this->error("Jigsaw binary not found in working directory or engine vendor path. Run `composer install` in the client root.");

            return self::FAILURE;
        }

        $this->info("Building static site (env: {$environment}) from {$workingDirectory}");

        $command = [
            PHP_BINARY,
            '-d',
            'auto_prepend_file=' . base_path('vendor/autoload.php'),
            $scriptToUse,
            'build',
            $environment,
        ];

        $process = new Process($command, $workingDirectory, [
            'JIGSAW_BASE' => $workingDirectory,
        ]);

        $process->run(function ($type, $buffer): void {
            $type === Process::ERR ? $this->error(trim($buffer)) : $this->line(trim($buffer));
        });

        if (! $process->isSuccessful()) {
            $this->error('Jigsaw build failed.');

            return self::FAILURE;
        }

        $this->info('Jigsaw build completed.');

        return self::SUCCESS;
    }
}

