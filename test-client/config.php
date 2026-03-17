<?php

use Prism\Core\Prism;

return Prism::configure(
    project_name: 'test-client',
    theme_preset: 'clinical',
    compliance_mode: 'supplements',
    brand_colors: [
        'primary' => '#000000',
        'secondary' => '#1f2937',
    ],
    niche: array (
  'fda_disclaimer' => 'These statements have not been evaluated by the Food and Drug Administration. This product is not intended to diagnose, treat, cure, or prevent any disease.',
  'supplement_facts_format' => 'standard',
),
);
