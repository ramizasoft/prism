<?php

declare(strict_types=1);

use Tests\Concerns\InteractsWithTemporaryClient;

uses(InteractsWithTemporaryClient::class);

it('renders the nutrition facts panel with food config data', function (): void {
    $this->setupTemporaryClient('nutrition-facts');

    $this->createSourceFile('product.blade.php', <<<'BLADE'
---
extends: prism::layouts.app
title: Tasty Snack
---

<x-prism::nutrition-facts :data="$page->niche->nutrition_facts" />
BLADE);

    $this->createConfigFile([
        'project_name' => 'Food Brand',
        'theme_preset' => 'clinical',
        'compliance_mode' => 'food',
        'brand_colors' => [
            'primary' => '#000000',
            'secondary' => '#ffffff',
        ],
        'niche' => [
            'nutrition_facts' => [
                'serving_size' => '1 Bar (50g)',
                'servings_per_container' => '12',
                'calories' => 250,
                'total_fat' => '10g',
                'protein' => '20g',
                'vitamins_minerals' => [
                    ['name' => 'Vitamin D', 'amount' => '2mcg', 'daily_value' => 10],
                    ['name' => 'Calcium', 'amount' => '260mg', 'daily_value' => 20],
                ],
            ],
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

    $html = $this->getBuildFileContent('product.html');

    expect($html)->toContain('Nutrition Facts');
    expect($html)->toContain('1 Bar (50g)');
    expect($html)->toContain('250');
    expect($html)->toContain('20g');
    expect($html)->toContain('Vitamin D');
    expect($html)->toContain('260mg');

    $this->cleanupTemporaryClient();
});
