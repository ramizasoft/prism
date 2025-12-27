<?php

declare(strict_types=1);

namespace Prism\Core\Commands;

use Illuminate\Support\Facades\Process;
use LaravelZero\Framework\Commands\Command;

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
        $folderName = \Illuminate\Support\Str::slug($name);

        $niche = $this->choice('Choose a niche', [
            'Clinical',
            'Playful',
            'Luxury',
            'Organic',
        ], 'Clinical');

        $color = $this->ask('What is the primary brand color (hex)?', '#000000');

        $this->info("Creating client: {$name} ({$niche}, {$color})...");

        $repoUrl = 'https://github.com/prism/starter-template.git';

        $this->info("Cloning starter repository...");
        $result = Process::run("git clone {$repoUrl} {$folderName}");

        if ($result->failed()) {
            $this->error("Failed to clone repository: " . $result->errorOutput());
            return;
        }

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

        $this->info("Configuring client...");

        $stub = \Illuminate\Support\Facades\File::get(__DIR__ . '/../../stubs/config.php.stub');

        $complianceMode = match ($niche) {
            'Clinical' => 'supplements',
            'Playful' => 'pet_food',
            default => 'none',
        };

        $themePreset = strtolower($niche);

        $configContent = str_replace(
            ['{{ project_name }}', '{{ theme_preset }}', '{{ compliance_mode }}', '{{ primary_color }}'],
            [$name, $themePreset, $complianceMode, $color],
            $stub
        );

        if (! \Illuminate\Support\Facades\File::isDirectory($folderName)) {
            $this->error("Target directory does not exist. Clone failed?");
            return;
        }

        \Illuminate\Support\Facades\File::put($folderName . '/config.php', $configContent);

        $this->info("Client site created successfully!");
        $this->comment("To get started:");
        $this->line("  cd {$folderName}");
        $this->line("  npm run dev");
    }
}
