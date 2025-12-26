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

        $cssVariables = [
            '--prism-color-primary' => $brandColors->primary,
            '--prism-color-secondary' => $brandColors->secondary,
        ];

        $jigsaw->setConfig('prism_theme_vars', $cssVariables);
    }
}

