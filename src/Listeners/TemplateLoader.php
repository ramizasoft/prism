<?php

declare(strict_types=1);

namespace Prism\Core\Listeners;

use Prism\Core\Data\ConfigData;
use TightenCo\Jigsaw\Jigsaw;

class TemplateLoader
{
    /**
     * Map of component aliases to their internal view paths.
     */
    protected const ALIASES = [
        'prism::test' => 'prism::components.test',
        'prism::ui.header' => 'prism::components.ui.header',
        'prism::ui.footer' => 'prism::components.ui.footer',
        'prism::ui.hero' => 'prism::components.ui.hero',
        'prism::ui.product-card' => 'prism::components.ui.product-card',
        'prism::layout.base' => 'prism::components.layout.base',
        'prism::compliance-footer' => 'prism::components.compliance-footer',
        'prism::supplement-facts' => 'prism::components.supplement-facts',
        'prism::nutrition-facts' => 'prism::components.nutrition-facts',
        'prism::compliance.badges.gmp' => 'prism::components.compliance.badges.gmp',
        'prism::compliance.badges.fda-registered' => 'prism::components.compliance.badges.fda-registered',
        'prism::compliance.badges.made-in-usa' => 'prism::components.compliance.badges.made-in-usa',
        'prism::compliance.badges.fda-shield' => 'prism::components.compliance.badges.fda-shield',
        'prism::compliance.badges.vet-recommended' => 'prism::components.compliance.badges.vet-recommended',
        'prism::cosmetic.science-section' => 'prism::components.cosmetic.science-section',
        'prism::eco.sustainability-section' => 'prism::components.eco.sustainability-section',
        'prism::tech.support-hub' => 'prism::components.tech.support-hub',
        'prism::pet.safety-section' => 'prism::components.pet.safety-section',
    ];

    protected const LUXURY_ALIASES = [
        'prism::layout.base' => 'prism::themes.luxury.components.layout.base',
        'prism::ui.header' => 'prism::themes.luxury.components.ui.header',
        'prism::ui.hero' => 'prism::themes.luxury.components.ui.hero',
        'prism::ui.footer' => 'prism::themes.luxury.components.ui.footer',
        'prism::ui.product-card' => 'prism::themes.luxury.components.ui.product-card',
    ];

    protected const ECO_ALIASES = [
        'prism::layout.base' => 'prism::themes.eco.components.layout.base',
        'prism::ui.header' => 'prism::themes.eco.components.ui.header',
        'prism::ui.hero' => 'prism::themes.eco.components.ui.hero',
        'prism::ui.footer' => 'prism::themes.eco.components.ui.footer',
        'prism::ui.product-card' => 'prism::themes.eco.components.ui.product-card',
    ];

    protected const ORGANIC_ALIASES = [
        'prism::layout.base' => 'prism::themes.organic.components.layout.base',
        'prism::ui.header' => 'prism::themes.organic.components.ui.header',
        'prism::ui.hero' => 'prism::themes.organic.components.ui.hero',
        'prism::ui.footer' => 'prism::themes.organic.components.ui.footer',
        'prism::ui.product-card' => 'prism::themes.organic.components.ui.product-card',
    ];

    protected const CLINICAL_ALIASES = [
        'prism::layout.base' => 'prism::themes.clinical.components.layout.base',
        'prism::ui.header' => 'prism::themes.clinical.components.ui.header',
        'prism::ui.hero' => 'prism::themes.clinical.components.ui.hero',
        'prism::ui.footer' => 'prism::themes.clinical.components.ui.footer',
        'prism::ui.product-card' => 'prism::themes.clinical.components.ui.product-card',
    ];

    protected const PLAYFUL_ALIASES = [
        'prism::layout.base' => 'prism::themes.playful.components.layout.base',
        'prism::ui.header' => 'prism::themes.playful.components.ui.header',
        'prism::ui.hero' => 'prism::themes.playful.components.ui.hero',
        'prism::ui.footer' => 'prism::themes.playful.components.ui.footer',
        'prism::ui.product-card' => 'prism::themes.playful.components.ui.product-card',
    ];

    public function handle(Jigsaw $jigsaw): void
    {
        $preset = $this->resolveThemePreset($jigsaw);
        $isOrganicTheme = str_starts_with($preset, 'organic');
        $isClinicalSubTheme = str_starts_with($preset, 'clinical-');
        $isPlayfulSubTheme = str_starts_with($preset, 'playful-');
        $isLuxuryTheme = str_starts_with($preset, 'luxury');
        $isEcoTheme = str_starts_with($preset, 'eco');

        $engineViews = realpath(__DIR__ . '/../../resources/views');

        if (! $engineViews || ! is_dir($engineViews)) {
            throw new \RuntimeException("Prism engine views not found at " . __DIR__ . '/../../resources/views');
        }

        // 1. Register 'prism' namespace
        if ($isOrganicTheme) {
            $organicViews = realpath(__DIR__ . '/../../resources/views/themes/organic');
            if ($organicViews && is_dir($organicViews)) {
                // Ensure prism::layouts.* can be overridden for organic themes
                $this->registerNamespace($jigsaw, 'prism', $organicViews);
            }
        }

        if ($isClinicalSubTheme) {
            $clinicalViews = realpath(__DIR__ . '/../../resources/views/themes/clinical');
            if ($clinicalViews && is_dir($clinicalViews)) {
                $this->registerNamespace($jigsaw, 'prism', $clinicalViews);
            }
        }

        if ($isPlayfulSubTheme) {
            $playfulViews = realpath(__DIR__ . '/../../resources/views/themes/playful');
            if ($playfulViews && is_dir($playfulViews)) {
                $this->registerNamespace($jigsaw, 'prism', $playfulViews);
            }
        }

        if ($isLuxuryTheme) {
            $luxuryViews = realpath(__DIR__ . '/../../resources/views/themes/luxury');
            if ($luxuryViews && is_dir($luxuryViews)) {
                $this->registerNamespace($jigsaw, 'prism', $luxuryViews);
            }
        }

        if ($isEcoTheme) {
            $ecoViews = realpath(__DIR__ . '/../../resources/views/themes/eco');
            if ($ecoViews && is_dir($ecoViews)) {
                $this->registerNamespace($jigsaw, 'prism', $ecoViews);
            }
        }

        $this->registerNamespace($jigsaw, 'prism', $engineViews);

        // 2. Register Blade components
        $this->registerComponents($jigsaw, $preset);
    }

    protected function registerNamespace(Jigsaw $jigsaw, string $namespace, string $path): void
    {
        // Jigsaw Config
        $existing = $jigsaw->getConfig('viewHintPaths') ?? [];
        $existing[$namespace][] = $path;
        $jigsaw->setConfig('viewHintPaths', $existing);

        // View Factory
        $viewFactory = $jigsaw->app['view'] ?? null;
        if ($viewFactory !== null && method_exists($viewFactory, 'addNamespace')) {
            $viewFactory->addNamespace($namespace, $path);
        }

        // View Finder
        if (isset($jigsaw->app['view.finder'])) {
            $finder = $jigsaw->app['view.finder'];
            if (method_exists($finder, 'getPaths') && method_exists($finder, 'setPaths')) {
                $paths = $finder->getPaths();
                $paths[] = $path;
                $finder->setPaths(array_unique($paths));
            }
        }
    }

    protected function registerComponents(Jigsaw $jigsaw, string $preset): void
    {
        if (! isset($jigsaw->app['blade.compiler'])) {
            return;
        }

        $blade = $jigsaw->app['blade.compiler'];

        $aliases = static::ALIASES;
        if (str_starts_with($preset, 'organic')) {
            // Organic overrides should win if they share the same alias keys.
            $aliases = array_merge($aliases, static::ORGANIC_ALIASES);
        }
        if (str_starts_with($preset, 'clinical-')) {
            $aliases = array_merge($aliases, static::CLINICAL_ALIASES);
        }
        if (str_starts_with($preset, 'playful-')) {
            $aliases = array_merge($aliases, static::PLAYFUL_ALIASES);
        }
        if (str_starts_with($preset, 'luxury')) {
            $aliases = array_merge($aliases, static::LUXURY_ALIASES);
        }
        if (str_starts_with($preset, 'eco')) {
            $aliases = array_merge($aliases, static::ECO_ALIASES);
        }

        foreach ($aliases as $alias => $view) {
            $blade->component($view, $alias);
        }
    }

    protected function resolveThemePreset(Jigsaw $jigsaw): string
    {
        $configData = $jigsaw->app->has(ConfigData::class)
            ? $jigsaw->app->make(ConfigData::class)
            : null;

        return $configData?->theme_preset ?? 'clinical';
    }
}
