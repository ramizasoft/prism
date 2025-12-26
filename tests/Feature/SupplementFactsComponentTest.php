<?php

declare(strict_types=1);

use Prism\Core\Listeners\BuildValidator;
use Prism\Core\Listeners\TemplateLoader;
use Prism\Core\Listeners\ThemeInjector;
use Tests\Concerns\InteractsWithTemporaryClient;

uses(InteractsWithTemporaryClient::class);

it('renders structured supplement facts panel', function (): void {
    $this->setupTemporaryClient('supplement-facts');

    $this->createSourceFile('index.blade.php', <<<'BLADE'
---
extends: prism::layouts.app
supplement:
  serving_size: "1 Scoop (20g)"
  servings_per_container: "30"
  nutrients:
    - name: "Protein"
      amount: "20 g"
      dv_percent: 40
      source: "Whey isolate"
    - name: "Vitamin C"
      amount: "90 mg"
      dv_percent: null
      source: "Ascorbic acid"
  proprietary_blends:
    - name: "Muscle Blend"
      amount: "5 g"
      ingredients:
        - "Creatine Monohydrate"
        - "BCAA Complex"
---

<x-prism::supplement-facts :data="$page->supplement" />
BLADE);

    $this->createConfigFile([
        'project_name' => 'Supplement Facts Test',
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

    expect($html)->toContain('Supplement Facts');
    expect($html)->toContain('Serving Size');
    expect($html)->toContain('Servings Per Container');
    expect($html)->toContain('Amount Per Serving');
    expect($html)->toContain('% Daily Value');
    expect($html)->toContain('Protein');
    expect($html)->toContain('20 g');
    expect($html)->toContain('40%');
    expect($html)->toContain('Vitamin C');
    expect($html)->toContain('90 mg');
    expect($html)->toContain('†');
    expect($html)->toContain('Muscle Blend');
    expect($html)->toContain('Creatine Monohydrate');
    expect($html)->toContain('BCAA Complex');

    $this->cleanupTemporaryClient();
});

