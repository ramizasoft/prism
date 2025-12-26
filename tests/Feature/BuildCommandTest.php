<?php

declare(strict_types=1);

use Tests\Concerns\InteractsWithTemporaryClient;

uses(InteractsWithTemporaryClient::class);

it('builds the site into build_local when run from a client root', function (): void {
    $this->setupTemporaryClient('jigsaw-client');

    $this->createSourceFile('index.blade.php', "<html><body>Hello Prism</body></html>\n");
    $this->createConfigFileRaw("<?php\n\nreturn [];\n");
    $this->createBootstrapFile("<?php\n\nuse Prism\Core\Listeners\TemplateLoader;\n\nreturn [
    'beforeBuild' => [TemplateLoader::class],
];\n");

    $exitCode = $this->runBuildCommand();

    expect($exitCode)->toBe(0);
    $this->assertBuildFileExists('index.html');

    $this->cleanupTemporaryClient();
});