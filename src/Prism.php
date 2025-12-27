<?php

declare(strict_types=1);

namespace Prism\Core;

use Prism\Core\Data\Niche\NicheConfig;

/**
 * Prism Engine Entry Point
 * 
 * Provides fluent configuration and access to engine features.
 */
final class Prism
{
    /**
     * Fluent configuration helper for client config.php.
     * 
     * Using this method provides IDE autocompletion and type-safety 
     * for client-side configuration.
     *
     * @param string $project_name The name of your brand.
     * @param string $theme_preset Visual style: 'clinical', 'playful', 'luxury', 'organic'.
     * @param string $compliance_mode Compliance mode: 'none', 'supplements', 'pet_food'.
     * @param array{primary: string, secondary: string} $brand_colors Branding colors.
     * @param array|null $niche Niche-specific configuration.
     * @return array
     */
    public static function configure(
        string $project_name,
        string $theme_preset,
        string $compliance_mode,
        array $brand_colors,
        ?array $niche = null
    ): array {
        return [
            'project_name' => $project_name,
            'theme_preset' => $theme_preset,
            'compliance_mode' => $compliance_mode,
            'brand_colors' => $brand_colors,
            'niche' => $niche,
        ];
    }
}
