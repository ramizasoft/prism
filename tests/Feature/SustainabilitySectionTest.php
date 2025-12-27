<?php

declare(strict_types=1);

use Tests\Concerns\InteractsWithTemporaryClient;

uses(InteractsWithTemporaryClient::class);

it('renders the sustainability section with eco config data', function (): void {
    $this->setupTemporaryClient('sustainability-section');

    $this->createSourceFile('sustainability.blade.php', <<<'BLADE'
---
extends: prism::layouts.app
title: Sustainability
---

<x-prism::eco.sustainability-section 
    title="Custom Mission Title" 
    :niche="$page->niche"
/>
BLADE);

    $this->createConfigFile([
        'project_name' => 'Eco Brand',
        'theme_preset' => 'organic',
        'compliance_mode' => 'eco',
        'brand_colors' => [
            'primary' => '#059669',
            'secondary' => '#ffffff',
        ],
        'niche' => [
            'sustainability_mission' => 'CUSTOM ECO MISSION STATEMENT.',
            'certifications' => ['B-Corp', 'Climate Pledge Friendly'],
        ],
    ]);

    $this->createManifestFile('manifest.json', [
        'resources/assets/css/presets/clinical.css' => [
            'file' => 'clinical.css',
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
    if ($exitCode !== 0) {
        fwrite(STDERR, $this->getBuildOutput());
    }
    expect($exitCode)->toBe(0);

    $html = $this->getBuildFileContent('sustainability.html');

    expect($html)->toContain('Custom Mission Title');
    expect($html)->toContain('CUSTOM ECO MISSION STATEMENT.');
    expect($html)->toContain('B-Corp');
    expect($html)->toContain('Climate Pledge Friendly');

    $this->cleanupTemporaryClient();
});
