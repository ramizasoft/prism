<?php

declare(strict_types=1);

use Prism\Core\Listeners\BuildValidator;
use Prism\Core\Listeners\TemplateLoader;
use Prism\Core\Listeners\ThemeInjector;
use Tests\Concerns\InteractsWithTemporaryClient;

uses(InteractsWithTemporaryClient::class);

it('loads luxury noir theme layout and preset when preset is luxury-noir', function (): void {
    /** @var \Tests\TestCase&\Tests\Concerns\InteractsWithTemporaryClient $this */
    $this->setupTemporaryClient('theme-luxury-noir');

    $this->createSourceFile('index.blade.php', <<<'BLADE'
---
extends: prism::layouts.app
title: Luxury Noir Demo
---

<x-prism::ui.hero title="Midnight Atelier" subtitle="Testing luxury noir theme overrides" />
BLADE);

    $this->createConfigFile([
        'project_name' => 'Luxury Noir',
        'theme_preset' => 'luxury-noir',
        'compliance_mode' => 'none',
        'brand_colors' => [
            'primary' => '#0c0a0e',
            'secondary' => '#d4af6e',
        ],
    ]);

    $this->createManifestFile('manifest.json', [
        'resources/assets/css/presets/luxury-noir.css' => [
            'file' => 'luxury-noir.css',
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

    expect($html)->toContain('/assets/build/luxury-noir.css');
    expect($html)->toContain('Luxury Noir');
    expect($html)->toContain('prism-layer');

    $this->cleanupTemporaryClient();
});

