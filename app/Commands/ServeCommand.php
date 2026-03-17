<?php

declare(strict_types=1);

namespace Prism\Core\Commands;

use LaravelZero\Framework\Commands\Command;
use Symfony\Component\Process\Process;

use function base_path;

final class ServeCommand extends Command
{
    protected $signature = 'serve {--port=8000 : Port for the local preview server}';

    protected $description = 'Serve the Jigsaw site locally (thin-client preview).';

    public function handle(): int
    {
        $port = (string) $this->option('port');
        $workingDirectory = getcwd() ?: base_path();

        $sourcePath = $workingDirectory . DIRECTORY_SEPARATOR . 'source';
        if (! is_dir($sourcePath)) {
            $this->error("Missing source directory at {$sourcePath}. Ensure you run this from the client root.");

            return self::FAILURE;
        }

        $scriptToUse = $this->findJigsawBinary($workingDirectory);
        if (! $scriptToUse) {
            return self::FAILURE;
        }

        $bootstrapPath = $workingDirectory . DIRECTORY_SEPARATOR . 'bootstrap.php';
        $tempBootstrapCreated = false;

        if (! file_exists($bootstrapPath)) {
            $this->info('Zero-config: Injecting Prism engine listeners...');
            file_put_contents($bootstrapPath, $this->getBootstrapStub());
            $tempBootstrapCreated = true;
        }

        $this->info("Serving Jigsaw site at http://localhost:{$port} (cwd: {$workingDirectory})");

        try {
            $exitCode = $this->runJigsawServe($scriptToUse, $workingDirectory, $port);
        } finally {
            if ($tempBootstrapCreated && file_exists($bootstrapPath)) {
                unlink($bootstrapPath);
            }
        }

        return $exitCode === 0 ? self::SUCCESS : self::FAILURE;
    }

    private function findJigsawBinary(string $workingDirectory): ?string
    {
        $possiblePaths = [
            $workingDirectory . '/vendor/tightenco/jigsaw/jigsaw',
            $workingDirectory . '/vendor/bin/jigsaw',
            base_path('vendor/tightenco/jigsaw/jigsaw'),
            base_path('vendor/bin/jigsaw'),
        ];

        foreach ($possiblePaths as $path) {
            if (is_file($path)) {
                return $path;
            }
        }

        $this->error("Jigsaw binary not found. searched in:\n" . implode("\n", $possiblePaths));
        $this->error('Ensure you run this from the client root and dependencies are installed.');

        return null;
    }

    private function runJigsawServe(string $scriptToUse, string $workingDirectory, string $port): int
    {
        $autoload = $workingDirectory . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
        $prepend = is_file($autoload)
            ? $autoload
            : base_path('vendor/autoload.php');

        $command = [
            PHP_BINARY,
            '-d',
            'auto_prepend_file=' . $prepend,
            $scriptToUse,
            'serve',
            '--port=' . $port,
        ];

        $process = new Process($command, $workingDirectory, [
            'JIGSAW_BASE' => $workingDirectory,
        ]);

        $process->setTimeout(null);
        $process->run(function ($type, $buffer): void {
            $type === Process::ERR ? $this->error(trim($buffer)) : $this->line(trim($buffer));
        });

        return (int) $process->getExitCode();
    }

    private function getBootstrapStub(): string
    {
        return <<<'PHP'
<?php

declare(strict_types=1);

/** @var \TightenCo\Jigsaw\Events\EventBus $events */

$events->beforeBuild(\Prism\Core\Listeners\BuildValidator::class);
$events->beforeBuild(\Prism\Core\Listeners\ThemeInjector::class);
$events->beforeBuild(\Prism\Core\Listeners\TemplateLoader::class);

PHP;
    }
}

