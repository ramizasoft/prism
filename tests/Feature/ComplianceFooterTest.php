<?php

declare(strict_types=1);

use Prism\Core\Listeners\BuildValidator;
use Prism\Core\Listeners\TemplateLoader;
use Prism\Core\Listeners\ThemeInjector;
use Tests\Concerns\InteractsWithTemporaryClient;

uses(InteractsWithTemporaryClient::class);

it('renders correct footer for compliance mode', function (string $mode, bool $shouldContain) {
    $this->setupTemporaryClient('compliance-footer-' . $mode);

    $this->createSourceFile('index.blade.php', <<<'BLADE'
---
extends: prism::components.layout.base
---
<x-prism::ui.footer />
BLADE);

    $this->createConfigFile([
        'project_name' => 'Prism Compliance Test',
        'theme_preset' => 'clinical',
        'compliance_mode' => $mode,
        'brand_colors' => [
            'primary' => '#111111',
            'secondary' => '#222222',
        ],
        'niche' => [
            'fda_disclaimer' => 'These statements...',
            'supplement_facts_format' => 'standard',
        ],
        'compliance' => [
            'fda_disclaimer' => 'Custom FDA text',
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

    if ($shouldContain) {
        expect($html)->toContain('Custom FDA text');
    } else {
        expect($html)->not->toContain('Custom FDA text');
        expect($html)->not->toContain('These statements have not been evaluated');
    }

    $this->cleanupTemporaryClient();
})->with([
    ['supplements', true],
    ['none', false],
]);