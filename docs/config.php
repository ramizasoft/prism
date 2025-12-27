<?php

use Prism\Core\Prism;

return Prism::configure(
    project_name: 'Prism Documentation',
    theme_preset: 'clinical',
    compliance_mode: 'none',
    brand_colors: [
        'primary' => '#0a192f',
        'secondary' => '#00a79d',
    ],
);