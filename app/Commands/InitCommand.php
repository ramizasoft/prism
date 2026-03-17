<?php

declare(strict_types=1);

namespace Prism\Core\Commands;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str as StrSupport;
use LaravelZero\Framework\Commands\Command;

class InitCommand extends Command
{
    protected $signature = 'init {name? : The name of the project}';

    protected $description = 'Initialize a new Prism project in the current directory';

    public function handle(): void
    {
        $this->info('Initializing new Prism project...');

        // 1. Gather Info
        $name = $this->argument('name') ?? $this->ask('What is the Project Name? (e.g., The Happy Pet)');
        $themePreset = $this->choice('Choose a Theme Preset', [
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

        $color = $this->ask('Primary Brand Color (Hex)?', '#000000');

        $defaultCompliance = match (true) {
            str_starts_with($themePreset, 'clinical') => 'supplements',
            str_starts_with($themePreset, 'playful') => 'pet_food',
            default => 'none',
        };

        $compliance = $this->choice('Choose a Compliance Mode', [
            'none',
            'supplements',
            'pet_food',
        ], $defaultCompliance);

        // 2. Generate config.php
        $this->task('Generating config.php', function () use ($name, $themePreset, $color, $compliance) {
            $stubPath = base_path('stubs/config.php.stub');
            if (! File::exists($stubPath)) {
                throw new \RuntimeException("Missing config stub at {$stubPath}");
            }

            $niche = $this->defaultNicheLiteral($compliance);

            $content = str_replace(
                ['{{ project_name }}', '{{ theme_preset }}', '{{ compliance_mode }}', '{{ primary_color }}', '{{ niche }}'],
                [$name, $themePreset, $compliance, $color, $niche],
                File::get($stubPath)
            );

            File::put(getcwd() . DIRECTORY_SEPARATOR . 'config.php', $content);
        });

        // 3. Generate bootstrap.php
        $this->task('Generating bootstrap.php', function () {
            $stubPath = base_path('stubs/bootstrap.php.stub');
            if (! File::exists($stubPath)) {
                throw new \RuntimeException("Missing bootstrap stub at {$stubPath}");
            }
            File::put(getcwd() . DIRECTORY_SEPARATOR . 'bootstrap.php', File::get($stubPath));
        });

        // 4. Create Source Directory + starter pages
        $this->task('Creating source directory', function () use ($name) {
            $cwd = getcwd();
            if (! $cwd) {
                throw new \RuntimeException('Unable to resolve current working directory.');
            }

            $sourceDir = $cwd . DIRECTORY_SEPARATOR . 'source';
            if (! File::isDirectory($sourceDir)) {
                File::makeDirectory($sourceDir);
            }

            $indexPath = $sourceDir . DIRECTORY_SEPARATOR . 'index.blade.php';
            if (! File::exists($indexPath)) {
                $stubPath = base_path('stubs/index.blade.php.stub');
                if (! File::exists($stubPath)) {
                    throw new \RuntimeException("Missing index stub at {$stubPath}");
                }

                $content = str_replace(
                    ['{{ title }}', '{{ subtitle }}'],
                    [$name, 'Launch a high-converting brand home that sends shoppers to Amazon (and builds trust first).'],
                    File::get($stubPath),
                );

                File::put($indexPath, $content);
            }

            $productsDir = $sourceDir . DIRECTORY_SEPARATOR . '_products';
            if (! File::isDirectory($productsDir)) {
                File::makeDirectory($productsDir);
            }

            $exampleProductPath = $productsDir . DIRECTORY_SEPARATOR . 'example-product.md';
            if (! File::exists($exampleProductPath)) {
                $stubPath = base_path('stubs/product.example.md.stub');
                if (! File::exists($stubPath)) {
                    throw new \RuntimeException("Missing example product stub at {$stubPath}");
                }
                File::put($exampleProductPath, File::get($stubPath));
            }
        });

        // 5. Configure composer.json if it exists, or create it
        $this->task('Configuring composer.json', function () use ($name) {
            $composerPath = getcwd() . '/composer.json';
            $packageName = 'client/' . StrSupport::slug($name);
            
            if (File::exists($composerPath)) {
                $composer = json_decode(File::get($composerPath), true);
            } else {
                $composer = [
                    'name' => $packageName,
                    'type' => 'project',
                    'require' => [],
                ];
            }

            // Ensure ramizasoft/prism is required
            $composer['require']['ramizasoft/prism'] = '^1.0';
            
            // Write back formatted JSON
            File::put($composerPath, json_encode($composer, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        });

        // 6. Configure Node toolchain (Vite + Tailwind)
        $this->task('Configuring frontend build (Vite + Tailwind)', function () use ($name) {
            $cwd = getcwd();
            if (! $cwd) {
                throw new \RuntimeException('Unable to resolve current working directory.');
            }

            $slug = StrSupport::slug($name);
            $files = [
                'package.json' => base_path('stubs/package.json.stub'),
                'vite.config.js' => base_path('stubs/vite.config.js.stub'),
                'tailwind.config.js' => base_path('stubs/tailwind.config.js.stub'),
                'postcss.config.js' => base_path('stubs/postcss.config.js.stub'),
                '.gitignore' => base_path('stubs/gitignore.stub'),
            ];

            foreach ($files as $target => $stubPath) {
                if (! File::exists($stubPath)) {
                    throw new \RuntimeException("Missing stub at {$stubPath}");
                }

                $targetPath = $cwd . DIRECTORY_SEPARATOR . $target;
                if (File::exists($targetPath)) {
                    continue;
                }

                $content = File::get($stubPath);
                if ($target === 'package.json') {
                    $content = str_replace('{{ package_name }}', $slug ?: 'prism-client', $content);
                }

                File::put($targetPath, $content);
            }
        });

        $this->newLine();
        $this->info('Project initialized successfully!');
        $this->comment('Next steps:');
        $this->line('1. Run `composer install` to install PHP dependencies.');
        $this->line('2. Run `npm install` to install frontend build tools.');
        $this->line('3. Run `npm run dev` to build assets + site (local).');
        $this->line('4. Run `npm run preview` to serve the site locally.');
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