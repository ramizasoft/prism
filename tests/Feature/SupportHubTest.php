<?php

declare(strict_types=1);

use Tests\Concerns\InteractsWithTemporaryClient;

uses(InteractsWithTemporaryClient::class);

it('renders the support hub with tech config data', function (): void {
    $this->setupTemporaryClient('support-hub');

    $this->createSourceFile('support.blade.php', <<<'BLADE'
---
extends: prism::layouts.app
title: Support
---

<x-prism::tech.support-hub 
    title="Tech Support" 
    :niche="$page->niche"
/>
BLADE);

    $this->createConfigFile([
        'project_name' => 'Tech Brand',
        'theme_preset' => 'clinical',
        'compliance_mode' => 'tech',
        'brand_colors' => [
            'primary' => '#3b82f6',
            'secondary' => '#111827',
        ],
        'niche' => [
            'support_hub_enabled' => true,
            'manual_url' => 'https://example.com/manual.pdf',
            'video_guide_url' => 'https://example.com/video',
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

    $html = $this->getBuildFileContent('support.html');

    expect($html)->toContain('Tech Support');
    expect($html)->toContain('https://example.com/manual.pdf');
    expect($html)->toContain('https://example.com/video');
    expect($html)->toContain('Download Manual (PDF)');
    expect($html)->toContain('Watch Setup Video');

    $this->cleanupTemporaryClient();
});
