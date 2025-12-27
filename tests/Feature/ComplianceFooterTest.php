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

    // Build the configuration.
    // We only provide 'niche' data if the mode requires it (supplements/pet_food)
    // to match strict DTO validation rules.
    $config = [
        'project_name' => 'Prism Compliance Test',
        'theme_preset' => 'clinical',
        'compliance_mode' => $mode,
        'brand_colors' => [
            'primary' => '#111111',
            'secondary' => '#222222',
        ],
    ];

    if ($mode === 'supplements') {
        $config['niche'] = [
            'fda_disclaimer' => 'Valid DTO Disclaimer Text',
            'supplement_facts_format' => 'standard',
        ];
    }

    $this->createConfigFile($config);

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
    
    // Debug output if build fails
    if ($exitCode !== 0) {
        $this->debugBuildOutput();
    }
    
    expect($exitCode)->toBe(0);

    $html = $this->getBuildFileContent('index.html');

    if ($shouldContain) {
        expect($html)->toContain('Valid DTO Disclaimer Text');
        // Ensure the shield icon is rendered (part of the new component)
        expect($html)->toContain('<svg'); 
    } else {
        expect($html)->not->toContain('Valid DTO Disclaimer Text');
    }

    $this->cleanupTemporaryClient();
})->with([
    ['supplements', true],
    ['none', false],
]);
