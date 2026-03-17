<?php

declare(strict_types=1);

use Prism\Core\Listeners\BuildValidator;
use Prism\Core\Listeners\TemplateLoader;
use Prism\Core\Listeners\ThemeInjector;
use Tests\Concerns\InteractsWithTemporaryClient;

uses(InteractsWithTemporaryClient::class);

it('loads eco clean minimal theme layout and preset when preset is eco-clean-minimal', function (): void {
    /** @var \Tests\TestCase&\Tests\Concerns\InteractsWithTemporaryClient $this */
    $this->setupTemporaryClient('theme-eco-clean-minimal');

    $this->createSourceFile('index.blade.php', <<<'BLADE'
---
extends: prism::layouts.app
title: Eco Clean Demo
---

<x-prism::ui.hero title="CleanEarth" subtitle="Testing eco clean minimal theme overrides" />
BLADE);

    $this->createConfigFile([
        'project_name' => 'Eco Clean Minimal',
        'theme_preset' => 'eco-clean-minimal',
        'compliance_mode' => 'none',
        'brand_colors' => [
            'primary' => '#4a7c5e',
            'secondary' => '#a3c4bc',
        ],
    ]);

    $this->createManifestFile('manifest.json', [
        'resources/assets/css/presets/eco-clean-minimal.css' => [
            'file' => 'eco-clean-minimal.css',
            'isEntry' => true,
        ],
    ]);

    $this->createBootstrapFile(<<<'PHP'
<?php

use Prism\Core\Listeners\BuildValidator;
use Prism\Core\Listeners\TemplateLoader;
use Prism\Core\Listeners\ThemeInjector;

/** @var \TightenCo\Jigsaw\Events\EventBus $events */
$events->beforeBuild([
    BuildValidator::class,
    TemplateLoader::class,
    ThemeInjector::class,
]);
PHP
    );

    $exitCode = $this->runBuildCommand();
    expect($exitCode)->toBe(0);

    $html = $this->getBuildFileContent('index.html');

    expect($html)->toContain('/assets/build/eco-clean-minimal.css');
    expect($html)->toContain('Eco Clean Minimal');
    expect($html)->toContain('prism-layer');

    $this->cleanupTemporaryClient();
});

