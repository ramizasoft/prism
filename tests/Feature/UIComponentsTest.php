<?php

declare(strict_types=1);

use Prism\Core\Listeners\BuildValidator;
use Prism\Core\Listeners\TemplateLoader;
use Prism\Core\Listeners\ThemeInjector;
use Tests\Concerns\InteractsWithTemporaryClient;

uses(InteractsWithTemporaryClient::class);

it('renders ui components with theming applied', function (): void {
    $this->setupTemporaryClient('ui-components');

    $this->createSourceFile('index.blade.php', <<<'BLADE'
---
extends: prism::layouts.app
title: Demo
---

<x-prism::ui.hero
    title="Demo Hero"
    subtitle="Testing components"
    cta-label="Click"
    cta-href="#products"
/>

<section id="products">
    <x-prism::ui.product-card title="Demo Product" price="$10" cta-label="Buy">
        Great product description.
    </x-prism::ui.product-card>
</section>
BLADE);

    $this->createConfigFile([
        'project_name' => 'Prism UI Demo',
        'theme_preset' => 'clinical',
        'compliance_mode' => 'none',
        'brand_colors' => [
            'primary' => '#123456',
            'secondary' => '#abcdef',
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

    expect($html)->toContain('--prism-color-primary: #123456');
    expect($html)->toContain('--prism-color-secondary: #abcdef');
    expect($html)->toContain('Demo Hero');
    expect($html)->toContain('Demo Product');
    expect($html)->toContain('bg-primary');
    expect($html)->toContain('/assets/build/clinical.css');

    $this->cleanupTemporaryClient();
});