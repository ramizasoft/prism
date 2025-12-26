<?php

declare(strict_types=1);

namespace Prism\Core\Listeners;

use TightenCo\Jigsaw\Jigsaw;

class TemplateLoader
{
    public function handle(Jigsaw $jigsaw): void
    {
        $engineViews = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'views';

        if (! is_dir($engineViews)) {
            // If the path is missing, fail fast with a clear message.
            throw new \RuntimeException("Prism engine views not found at {$engineViews}");
        }

        $existing = $jigsaw->getConfig('viewHintPaths') ?? [];
        $existing['prism'][] = $engineViews;
        $jigsaw->setConfig('viewHintPaths', $existing);

        $viewFactory = $jigsaw->app['view'] ?? null;

        if ($viewFactory !== null && method_exists($viewFactory, 'addNamespace')) {
            $viewFactory->addNamespace('prism', $engineViews);
        }

        if (isset($jigsaw->app['view.finder'])) {
            $finder = $jigsaw->app['view.finder'];
            if (method_exists($finder, 'getPaths') && method_exists($finder, 'setPaths')) {
                $paths = $finder->getPaths();
                $paths[] = $engineViews;
                $finder->setPaths(array_unique($paths));
            }
        }

        if (isset($jigsaw->app['blade.compiler'])) {
            $blade = $jigsaw->app['blade.compiler'];
            $componentsPath = $engineViews . DIRECTORY_SEPARATOR . 'components';

            $blade->anonymousComponentPath($componentsPath, 'prism');
            $blade->anonymousComponentNamespace($componentsPath, 'prism');

            // Explicit aliases for UI components
            $blade->component('prism::components.ui.header', 'prism::ui.header');
            $blade->component('prism::components.ui.footer', 'prism::ui.footer');
            $blade->component('prism::components.ui.hero', 'prism::ui.hero');
            $blade->component('prism::components.ui.product-card', 'prism::ui.product-card');
            $blade->component('prism::components.layout.base', 'prism::layout.base');
            $blade->component('prism::components.compliance-footer', 'prism::compliance-footer');
            $blade->component('prism::components.supplement-facts', 'prism::supplement-facts');
            $blade->component('prism::components.compliance.badges.gmp', 'prism::compliance.badges.gmp');
            $blade->component('prism::components.compliance.badges.fda-registered', 'prism::compliance.badges.fda-registered');
            $blade->component('prism::components.compliance.badges.made-in-usa', 'prism::compliance.badges.made-in-usa');
        }
    }
}

