<?php

declare(strict_types=1);

use Prism\Core\Listeners\BuildValidator;
use Prism\Core\Listeners\TemplateLoader;
use Prism\Core\Listeners\ThemeInjector;
use Tests\Concerns\InteractsWithTemporaryClient;

uses(InteractsWithTemporaryClient::class);

it('injects theme colors into built html', function (): void {
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