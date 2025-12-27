<?php

declare(strict_types=1);

namespace Prism\Core\Commands;

use Illuminate\Support\Facades\File;
use LaravelZero\Framework\Commands\Command;
use Illuminate\Support\Str;

class InitCommand extends Command
{
    protected $signature = 'init {name? : The name of the project}';

    protected $description = 'Initialize a new Prism project in the current directory';

    public function handle(): void
    {
        $this->info('Initializing new Prism project...');

        // 1. Gather Info
        $name = $this->argument('name') ?? $this->ask('What is the Project Name? (e.g., The Happy Pet)');
        
        $niche = $this->choice('Choose a Niche Preset', [
            'Clinical',
            'Playful',
            'Luxury',
            'Organic',
        ], 'Clinical');

        $color = $this->ask('Primary Brand Color (Hex)?', '#000000');

        $compliance = match ($niche) {
            'Clinical' => 'supplements',
            'Playful' => 'pet_food',
            default => 'none',
        };

        // 2. Generate config.php
        $this->task('Generating config.php', function () use ($name, $niche, $color, $compliance) {
            $stub = <<<'PHP'
<?php

use Prism\Core\Prism;

return Prism::configure(
    project_name: '{{ name }}',
    theme_preset: '{{ theme }}',
    compliance_mode: '{{ compliance }}',
    brand_colors: [
        'primary' => '{{ color }}',
        'secondary' => '#1f2937',
    ],
    niche: [],
);
PHP;
            $content = str_replace(
                ['{{ name }}', '{{ theme }}', '{{ compliance }}', '{{ color }}'],
                [$name, strtolower($niche), $compliance, $color],
                $stub
            );
            
            File::put(getcwd() . '/config.php', $content);
        });

        // 3. Generate bootstrap.php
        $this->task('Generating bootstrap.php', function () {
            $content = <<<'PHP'
<?php

/** @var \TightenCo\Jigsaw\Events\EventBus $events */

// 1. Validate configuration and bind DTO
$events->beforeBuild(\Prism\Core\Listeners\BuildValidator::class);

// 2. Inject theme variables from config
$events->beforeBuild(\Prism\Core\Listeners\ThemeInjector::class);

// 3. Register engine views and components
$events->beforeBuild(\Prism\Core\Listeners\TemplateLoader::class);
PHP;
            File::put(getcwd() . '/bootstrap.php', $content);
        });

        // 4. Create Source Directory
        $this->task('Creating source directory', function () use ($name) {
            if (!File::isDirectory(getcwd() . '/source')) {
                File::makeDirectory(getcwd() . '/source');
                
                $index = <<<'HTML'
@extends('_layouts.master')

@section('content')
<div class="container mx-auto py-12 text-center">
    <h1 class="text-4xl font-bold text-primary">Welcome to {{ name }}!</h1>
    <p class="mt-4 text-xl">Powered by Prism Engine.</p>
</div>
@endsection
HTML;
                File::put(getcwd() . '/source/index.blade.php', str_replace('{{ name }}', $name, $index));
            }
        });

        // 5. Update composer.json if it exists, or create it
        $this->task('Configuring composer.json', function () use ($name) {
            $composerPath = getcwd() . '/composer.json';
            $packageName = 'client/' . Str::slug($name);
            
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

        $this->newLine();
        $this->info('Project initialized successfully!');
        $this->comment('Next steps:');
        $this->line('1. Run `composer update` to install dependencies.');
        $this->line('2. Run `./vendor/bin/jigsaw build` to build your site.');
    }
}