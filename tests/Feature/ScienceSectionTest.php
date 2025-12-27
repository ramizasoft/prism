<?php

declare(strict_types=1);

use Tests\Concerns\InteractsWithTemporaryClient;

uses(InteractsWithTemporaryClient::class);

it('renders the science section with cosmetic config data', function (): void {
    $this->setupTemporaryClient('science-section');

    $this->createSourceFile('science.blade.php', <<<'BLADE'
---
extends: prism::layouts.app
title: Our Science
---

<x-prism::cosmetic.science-section 
    title="Custom Science Title" 
    subtitle="Custom Subtitle" 
    :niche="$page->niche"
/>
BLADE);

    $this->createConfigFile([
        'project_name' => 'Cosmetic Brand',
        'theme_preset' => 'luxury',
        'compliance_mode' => 'cosmetic',
        'brand_colors' => [
            'primary' => '#000000',
            'secondary' => '#ffffff',
        ],
        'niche' => [
            'science_page_enabled' => true,
            'disclaimer_text' => 'CUSTOM COSMETIC DISCLAIMER.',
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

    $html = $this->getBuildFileContent('science.html');

    expect($html)->toContain('Custom Science Title');
    expect($html)->toContain('Custom Subtitle');
    expect($html)->toContain('CUSTOM COSMETIC DISCLAIMER.');
    expect($html)->toContain('Barrier Support'); // Default content check

    $this->cleanupTemporaryClient();
});
