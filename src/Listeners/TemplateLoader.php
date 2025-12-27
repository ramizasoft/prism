<?php

declare(strict_types=1);

namespace Prism\Core\Listeners;

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
        'prism::compliance.badges.gmp' => 'prism::components.compliance.badges.gmp',
        'prism::compliance.badges.fda-registered' => 'prism::components.compliance.badges.fda-registered',
        'prism::compliance.badges.made-in-usa' => 'prism::components.compliance.badges.made-in-usa',
        'prism::compliance.badges.fda-shield' => 'prism::components.compliance.badges.fda-shield',
    ];

    public function handle(Jigsaw $jigsaw): void
    {
        $engineViews = realpath(__DIR__ . '/../../resources/views');

        if (! $engineViews || ! is_dir($engineViews)) {
            throw new \RuntimeException("Prism engine views not found at " . __DIR__ . '/../../resources/views');
        }

        // 1. Register 'prism' namespace
        $this->registerNamespace($jigsaw, 'prism', $engineViews);

        // 2. Register Blade components
        $this->registerComponents($jigsaw);
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

    protected function registerComponents(Jigsaw $jigsaw): void
    {
        if (! isset($jigsaw->app['blade.compiler'])) {
            return;
        }

        $blade = $jigsaw->app['blade.compiler'];

        foreach (static::ALIASES as $alias => $view) {
            $blade->component($view, $alias);
        }
    }
}
