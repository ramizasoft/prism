<?php

declare(strict_types=1);

use Prism\Core\Listeners\BuildValidator;
use Prism\Core\Listeners\TemplateLoader;
use Prism\Core\Listeners\ThemeInjector;
use Tests\Concerns\InteractsWithTemporaryClient;

uses(InteractsWithTemporaryClient::class);

it('injects theme colors into built html', function (): void {
    /** @var \Tests\TestCase&\Tests\Concerns\InteractsWithTemporaryClient $this */
    $this->setupTemporaryClient('theme-injector');

    $this->createSourceFile('index.blade.php', <<<'BLADE'
---
extends: prism::components.layout.base
---
<h1>Brand Test</h1>
BLADE);

    $this->createConfigFile([
        'project_name' => 'Prism Theme Test',
        'theme_preset' => 'clinical',
        'compliance_mode' => 'none',
        'brand_colors' => [
            'primary' => 'ff0000',
            'secondary' => '00ff00',
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

    expect($html)->toContain('--prism-color-primary: #ff0000');
    expect($html)->toContain('--prism-color-secondary: #00ff00');

    $this->cleanupTemporaryClient();
});

it('loads organic theme base layout when preset is organic-moss', function (): void {
    /** @var \Tests\TestCase&\Tests\Concerns\InteractsWithTemporaryClient $this */
    $this->setupTemporaryClient('theme-organic-moss');

    $this->createSourceFile('index.blade.php', <<<'BLADE'
---
extends: prism::layouts.app
title: Organic Demo
---

<x-prism::ui.hero title="Organic Moss" subtitle="Theme override test" />
BLADE);

    $this->createConfigFile([
        'project_name' => 'Organic Moss',
        'theme_preset' => 'organic-moss',
        'compliance_mode' => 'none',
        'brand_colors' => [
            'primary' => '#2d4a22',
            'secondary' => '#f5efe0',
        ],
    ]);

    $this->createManifestFile('manifest.json', [
        'resources/assets/css/presets/organic-moss.css' => [
            'file' => 'organic-moss.css',
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

    // Assert the page uses the organic app layout content and the organic preset entrypoint
    expect($html)->toContain('/assets/build/organic-moss.css');
    expect($html)->toContain('Organic Moss');
    expect($html)->toContain('prism-layer');

    $this->cleanupTemporaryClient();
});