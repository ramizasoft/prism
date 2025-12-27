<?php

declare(strict_types=1);

namespace Prism\Core\Listeners;

use Prism\Core\Data\ConfigData;
use RuntimeException;
use TightenCo\Jigsaw\Jigsaw;

class ThemeInjector
{
    public function handle(Jigsaw $jigsaw): void
    {
        $configData = $jigsaw->app->has(ConfigData::class)
            ? $jigsaw->app->make(ConfigData::class)
            : null;

        if ($configData === null) {
            throw new RuntimeException('ConfigData not bound; ensure BuildValidator runs before ThemeInjector.');
        }

        $brandColors = $configData->brand_colors;

        $normalize = fn (string $color) => str_starts_with($color, '#') ? $color : "#{$color}";

        $cssVariables = [
            '--prism-color-primary' => $normalize($brandColors->primary),
            '--prism-color-secondary' => $normalize($brandColors->secondary),
        ];

        $jigsaw->setConfig('prism_theme_vars', $cssVariables);
        $jigsaw->setConfig('prism_theme_preset', $configData->theme_preset);
        $jigsaw->setConfig('prism_project_name', $configData->project_name);
        $jigsaw->setConfig('niche', $configData->niche ? $configData->niche->toArray() : []);
    }
}

