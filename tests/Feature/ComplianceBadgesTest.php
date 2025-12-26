<?php

declare(strict_types=1);

use Prism\Core\Listeners\BuildValidator;
use Prism\Core\Listeners\TemplateLoader;
use Prism\Core\Listeners\ThemeInjector;
use Tests\Concerns\InteractsWithTemporaryClient;

uses(InteractsWithTemporaryClient::class);

it('renders compliance badge library with scalable svg attributes', function (): void {
    $this->setupTemporaryClient('compliance-badges');

    $this->createSourceFile('index.blade.php', <<<'BLADE'
---
extends: prism::layouts.app
title: Badges
---

<div class="space-y-6">
    <x-prism::compliance.badges.gmp class="w-20 text-primary" />
    <x-prism::compliance.badges.fda-registered class="w-24 text-secondary" />
    <x-prism::compliance.badges.made-in-usa class="w-32 text-primary" />
</div>
BLADE);

    $this->createConfigFile([
        'project_name' => 'Prism Compliance Badges',
        'theme_preset' => 'clinical',
        'compliance_mode' => 'supplements',
        'brand_colors' => [
            'primary' => '#0f172a',
            'secondary' => '#0ea5e9',
        ],
        'niche' => [
            'fda_disclaimer' => 'These statements have not been evaluated by the FDA.',
            'supplement_facts_format' => 'standard',
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

    $html = $this->getBuildFileContent('index.html');

    expect($html)->toContain('aria-label="GMP Certified Badge"');
    expect($html)->toContain('aria-label="FDA Registered Facility Badge"');
    expect($html)->toContain('aria-label="Made in USA Badge"');
    expect($html)->toContain('role="img"');
    expect($html)->toContain('w-20');
    expect($html)->toContain('w-24');
    expect($html)->toContain('w-32');

    $this->cleanupTemporaryClient();
});

