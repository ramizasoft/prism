<?php

declare(strict_types=1);

/**
 * Prism Client Bootstrapper
 *
 * This file registers the engine listeners that power the Thin Client.
 */

/** @var \TightenCo\Jigsaw\Events\EventBus $events */

// 1. Validate configuration and bind DTO
$events->beforeBuild(\Prism\Core\Listeners\BuildValidator::class);

// 2. Inject theme variables from config
$events->beforeBuild(\Prism\Core\Listeners\ThemeInjector::class);

// 3. Register engine views and components
$events->beforeBuild(\Prism\Core\Listeners\TemplateLoader::class);
