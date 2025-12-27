<?php

declare(strict_types=1);

use Tests\Concerns\InteractsWithTemporaryClient;

uses(InteractsWithTemporaryClient::class);

it('renders the pet safety section with config data', function (): void {
    $this->setupTemporaryClient('pet-safety-section');

    $this->createSourceFile('safety.blade.php', <<<'BLADE'
---
extends: prism::layouts.app
title: Pet Safety
---

<x-prism::pet.safety-section 
    title="Custom Safety Title" 
    :niche="$page->niche"
/>
BLADE);

    $this->createConfigFile([
        'project_name' => 'Pet Brand',
        'theme_preset' => 'playful',
        'compliance_mode' => 'pet_food',
        'brand_colors' => [
            'primary' => '#fbbf24', // Yellowish playful
            'secondary' => '#1e293b',
        ],
        'niche' => [
            'aafco_statement' => 'Standard AAFCO text.',
            'safety_promise' => 'CUSTOM PET SAFETY PROMISE.',
            'ingredients_summary' => 'CUSTOM INGREDIENT LIST.',
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
    expect($exitCode)->toBe(0);

    $html = $this->getBuildFileContent('safety.html');

    expect($html)->toContain('Custom Safety Title');
    expect($html)->toContain('CUSTOM PET SAFETY PROMISE.');
    expect($html)->toContain('CUSTOM INGREDIENT LIST.');
    expect($html)->toContain('Veterinarian Recommended Badge'); // ARIA label

    $this->cleanupTemporaryClient();
});
