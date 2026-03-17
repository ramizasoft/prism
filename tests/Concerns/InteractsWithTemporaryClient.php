<?php

declare(strict_types=1);

namespace Tests\Concerns;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;

trait InteractsWithTemporaryClient
{
    public string $tempRoot;
    public string $sourceDir;
    public string $buildDir;
    public string $configPath;
    public string $bootstrapPath;
    public Filesystem $filesystem;

    public function setupTemporaryClient(string $dirName): void
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

    public function createConfigFile(array $config): void
    {
        $content = "<?php\n\nreturn " . var_export($config, true) . ";\n";
        file_put_contents($this->configPath, $content);
    }

    public function createConfigFileRaw(string $content): void
    {
        file_put_contents($this->configPath, $content);
    }

    public function createBootstrapFile(string $content): void
    {
        file_put_contents($this->bootstrapPath, $content);
    }

    public function createSourceFile(string $path, string $content): void
    {
        $fullPath = $this->sourceDir . '/' . ltrim($path, '/');
        $this->filesystem->ensureDirectoryExists(dirname($fullPath));
        file_put_contents($fullPath, $content);
    }

    public function createManifestFile(string $path, array $content): void
    {
         $fullPath = $this->tempRoot . '/source/assets/build/' . ltrim($path, '/');
         $this->filesystem->ensureDirectoryExists(dirname($fullPath));
         file_put_contents($fullPath, json_encode($content, JSON_PRETTY_PRINT));
    }

    public function runBuildCommand(string $env = 'local'): int
    {
        $originalCwd = getcwd();
        chdir($this->tempRoot);

        try {
            return Artisan::call('build', ['env' => $env]);
        } finally {
            chdir($originalCwd ?: base_path());
        }
    }

    public function getBuildOutput(): string
    {
        return Artisan::output();
    }

    public function cleanupTemporaryClient(): void
    {
        if (isset($this->filesystem) && $this->filesystem->isDirectory($this->tempRoot)) {
            $this->filesystem->deleteDirectory($this->tempRoot);
        }
    }

    public function assertBuildFileExists(string $path): void
    {
        $resolved = $this->resolveBuildPath($path);
        expect(is_file($resolved))->toBeTrue();
    }

    public function getBuildFileContent(string $path): string
    {
        $resolved = $this->resolveBuildPath($path);

        return file_get_contents($resolved);
    }

    public function assertBuildFileContains(string $path, string $needle): void
    {
        $content = $this->getBuildFileContent($path);
        expect($content)->toContain($needle);
    }

    private function resolveBuildPath(string $path): string
    {
        $primary = $this->buildDir . '/' . ltrim($path, '/');

        if (is_file($primary)) {
            return $primary;
        }

        if (str_ends_with($path, '.html')) {
            $fallback = $this->buildDir . '/' . ltrim(str_replace('.html', '/index.html', $path), '/');
            if (is_file($fallback)) {
                return $fallback;
            }
        }

        return $primary;
    }
}
