<?php

declare(strict_types=1);

namespace Tests\Concerns;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;

trait InteractsWithTemporaryClient
{
    protected string $tempRoot;
    protected string $sourceDir;
    protected string $buildDir;
    protected string $configPath;
    protected string $bootstrapPath;
    protected Filesystem $filesystem;

    protected function setupTemporaryClient(string $dirName): void
    {
        $this->filesystem = new Filesystem();
        $this->tempRoot = base_path("tests/tmp/$dirName");
        $this->sourceDir = $this->tempRoot . '/source';
        $this->buildDir = $this->tempRoot . '/build_local';
        $this->configPath = $this->tempRoot . '/config.php';
        $this->bootstrapPath = $this->tempRoot . '/bootstrap.php';

        $this->cleanupTemporaryClient(); // Ensure clean slate
        $this->filesystem->makeDirectory($this->sourceDir, 0755, true);
    }

    protected function createConfigFile(array $config): void
    {
        $content = "<?php\n\nreturn " . var_export($config, true) . ";\n";
        file_put_contents($this->configPath, $content);
    }

    protected function createConfigFileRaw(string $content): void
    {
        file_put_contents($this->configPath, $content);
    }

    protected function createBootstrapFile(string $content): void
    {
        file_put_contents($this->bootstrapPath, $content);
    }

    protected function createSourceFile(string $path, string $content): void
    {
        $fullPath = $this->sourceDir . '/' . ltrim($path, '/');
        $this->filesystem->ensureDirectoryExists(dirname($fullPath));
        file_put_contents($fullPath, $content);
    }

    protected function createManifestFile(string $path, array $content): void
    {
         $fullPath = $this->tempRoot . '/source/assets/build/' . ltrim($path, '/');
         $this->filesystem->ensureDirectoryExists(dirname($fullPath));
         file_put_contents($fullPath, json_encode($content, JSON_PRETTY_PRINT));
    }

    protected function runBuildCommand(string $env = 'local'): int
    {
        $originalCwd = getcwd();
        chdir($this->tempRoot);

        try {
            return Artisan::call('build', ['env' => $env]);
        } finally {
            chdir($originalCwd ?: base_path());
        }
    }

    protected function getBuildOutput(): string
    {
        return Artisan::output();
    }

    protected function cleanupTemporaryClient(): void
    {
        if (isset($this->filesystem) && $this->filesystem->isDirectory($this->tempRoot)) {
            $this->filesystem->deleteDirectory($this->tempRoot);
        }
    }

    protected function assertBuildFileExists(string $path): void
    {
        expect(is_file($this->buildDir . '/' . ltrim($path, '/')))->toBeTrue();
    }

    protected function getBuildFileContent(string $path): string
    {
        return file_get_contents($this->buildDir . '/' . ltrim($path, '/'));
    }
}
