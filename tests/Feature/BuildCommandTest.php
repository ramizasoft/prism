<?php

declare(strict_types=1);

use Tests\Concerns\InteractsWithTemporaryClient;

uses(InteractsWithTemporaryClient::class);

it('builds the site into build_local when run from a client root', function (): void {
    $this->setupTemporaryClient('jigsaw-client');

    $this->createSourceFile('index.blade.php', "<html><body>Hello Prism</body></html>\n");
    $this->createSourceFile('test-view.blade.php', "<html><body><x-prism::test /></body></html>\n");
    $this->createConfigFileRaw(<<<'PHP'
<?php

return [
    'project_name' => 'Prism Test Client',
    'theme_preset' => 'clinical',
    'compliance_mode' => 'none',
    'brand_colors' => [
        'primary' => '#000000',
        'secondary' => '#111111',
    ],
    'niche' => null,
];
PHP
    );

    $exitCode = $this->runBuildCommand();

    if ($exitCode !== 0) {
        fwrite(STDERR, $this->getBuildOutput());
    }

    expect($exitCode)->toBe(0);
    $this->assertBuildFileExists('index.html');
    $this->assertBuildFileExists('test-view/index.html');
    expect($this->getBuildFileContent('test-view/index.html'))->toContain('Prism Core Component');

    $this->cleanupTemporaryClient();
});