<?php

declare(strict_types=1);

/**
 * Prism Client Configuration
 *
 * This file acts as the 'brain' of your client site.
 * It defines the project name, theme, and compliance settings.
 */

use Prism\Core\Prism;

return Prism::configure(
    project_name: 'Prism Starter Site',
    theme_preset: 'clinical',
    compliance_mode: 'supplements',
    brand_colors: [
        'primary' => '#0a192f',
        'secondary' => '#00a79d',
    ],
    niche: [
        'fda_disclaimer' => 'These statements have not been evaluated by the Food and Drug Administration. This product is not intended to diagnose, treat, cure, or prevent any disease.',
        'supplement_facts_format' => 'standard',
    ],
);
