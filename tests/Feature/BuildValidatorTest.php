<?php

declare(strict_types=1);

use Prism\Core\Listeners\BuildValidator;
use Prism\Core\Listeners\TemplateLoader;
use Tests\Concerns\InteractsWithTemporaryClient;

uses(InteractsWithTemporaryClient::class);

it('binds config data when config.php is valid', function (): void {
    $this->setupTemporaryClient('jigsaw-config-valid');

    $this->createSourceFile('index.blade.php', "<html><body>Hello Prism</body></html>\n");
    $this->createConfigFile([
        'project_name' => 'Prism Valid',
        'theme_preset' => 'clinical',
        'compliance_mode' => 'none',
        'brand_colors' => [
            'primary' => '#111111',
            'secondary' => '#222222',
        ],
    ]);

    $this->createBootstrapFile(<<<'PHP'
<?php

use Prism\Core\Listeners\BuildValidator;
use Prism\Core\Listeners\TemplateLoader;

/** @var \TightenCo\Jigsaw\Events\EventBus $events */
$events->beforeBuild([
    BuildValidator::class,
    TemplateLoader::class,
]);
PHP
    );

    $exitCode = $this->runBuildCommand();

    expect($exitCode)->toBe(0);
    $this->assertBuildFileExists('index.html');

    $this->cleanupTemporaryClient();
});

it('fails the build and surfaces validation errors for invalid config.php', function (): void {
    $this->setupTemporaryClient('jigsaw-config-invalid');

    $this->createSourceFile('index.blade.php', "<html><body>Hello Prism</body></html>\n");
    $this->createConfigFileRaw("<?php\n\nreturn [\n    'project_name' => 'Prism Invalid',
    'theme_preset' => 'clinical',
    'compliance_mode' => 'none',
];\n");

    $this->createBootstrapFile(<<<'PHP'
<?php

use Prism\Core\Listeners\BuildValidator;
use Prism\Core\Listeners\TemplateLoader;

/** @var \TightenCo\Jigsaw\Events\EventBus $events */
$events->beforeBuild([
    BuildValidator::class,
    TemplateLoader::class,
]);
PHP
    );

    $exitCode = $this->runBuildCommand();
    $output = $this->getBuildOutput();

    expect($exitCode)->toBe(1);
    expect($output)->toContain('Config Error:');
    expect($output)->toContain('brand_colors');

    $this->cleanupTemporaryClient();
});