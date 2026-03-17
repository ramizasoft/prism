<?php

declare(strict_types=1);

namespace Prism\Core\Commands;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Process;
use LaravelZero\Framework\Commands\Command;
use Illuminate\Support\Str;

class CreateClientCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'create:client {name?}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Scaffold a new client site';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $name = $this->argument('name') ?? $this->ask('What is the site title?');
        $folderName = Str::slug($name);

        $themePreset = $this->choice('Choose a theme preset', [
            'clinical',
            'clinical-precision',
            'clinical-lab',
            'clinical-sport',
            'playful',
            'playful-paws',
            'playful-boing',
            'playful-threads',
            'luxury',
            'luxury-noir',
            'luxury-velvet',
            'luxury-atelier',
            'organic',
            'organic-moss',
            'organic-apothecary',
            'organic-farmstead',
            'eco',
            'eco-clean-minimal',
            'eco-kraft',
        ], 'clinical');

        $color = $this->ask('What is the primary brand color (hex)?', '#000000');

        $defaultCompliance = match (true) {
            str_starts_with($themePreset, 'clinical') => 'supplements',
            str_starts_with($themePreset, 'playful') => 'pet_food',
            default => 'none',
        };

        $complianceMode = $this->choice('Choose a compliance mode', [
            'none',
            'supplements',
            'pet_food',
        ], $defaultCompliance);

        $this->info("Creating client: {$name} ({$themePreset}, {$complianceMode}, {$color})...");

        $templatePath = base_path('prism-starter');

        if (! File::isDirectory($templatePath)) {
            $this->error("Starter template not found at {$templatePath}");
            return;
        }

        if (File::exists($folderName)) {
            $this->error("Target directory already exists: {$folderName}");
            return;
        }

        $this->info('Scaffolding starter template...');
        File::copyDirectory($templatePath, $folderName);

        $this->info("Configuring client...");

        $stub = File::get(base_path('stubs/config.php.stub'));
        $nicheLiteral = $this->defaultNicheLiteral($complianceMode);

        $configContent = str_replace(
            ['{{ project_name }}', '{{ theme_preset }}', '{{ compliance_mode }}', '{{ primary_color }}', '{{ niche }}'],
            [$name, $themePreset, $complianceMode, $color, $nicheLiteral],
            $stub
        );

        if (! File::isDirectory($folderName)) {
            $this->error("Target directory does not exist. Scaffold failed?");
            return;
        }

        File::put($folderName . '/config.php', $configContent);

        // Keep package metadata consistent for the new client
        $this->configureClientPackageMetadata($folderName, $name);

        $this->info("Installing dependencies...");

        $result = Process::path($folderName)->run('composer install');
        if ($result->failed()) {
            $this->error("Failed to run composer install: " . $result->errorOutput());
            return;
        }

        $result = Process::path($folderName)->run('npm install');
        if ($result->failed()) {
            $this->error("Failed to run npm install: " . $result->errorOutput());
            return;
        }

        $this->info("Client site created successfully!");
        $this->comment("To get started:");
        $this->line("  cd {$folderName}");
        $this->line("  npm run dev");
    }

    private function configureClientPackageMetadata(string $folderName, string $projectName): void
    {
        $composerPath = $folderName . '/composer.json';
        if (File::exists($composerPath)) {
            $composer = json_decode(File::get($composerPath), true) ?: [];
            $composer['name'] = 'client/' . Str::slug($projectName);
            File::put($composerPath, json_encode($composer, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        }

        $packageJsonPath = $folderName . '/package.json';
        if (File::exists($packageJsonPath)) {
            $package = json_decode(File::get($packageJsonPath), true) ?: [];
            $package['name'] = Str::slug($projectName) ?: 'prism-client';
            File::put($packageJsonPath, json_encode($package, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        }
    }

    private function defaultNicheLiteral(string $complianceMode): string
    {
        return match ($complianceMode) {
            'supplements' => var_export([
                'fda_disclaimer' => 'These statements have not been evaluated by the Food and Drug Administration. This product is not intended to diagnose, treat, cure, or prevent any disease.',
                'supplement_facts_format' => 'standard',
            ], true),
            'pet_food' => var_export([
                'aafco_statement' => 'This product is formulated to meet the nutritional levels established by the AAFCO Dog Food Nutrient Profiles for all life stages.',
            ], true),
            default => 'null',
        };
    }
}
