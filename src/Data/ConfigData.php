<?php

declare(strict_types=1);

namespace Prism\Core\Data;

use Prism\Core\Data\Niche\NicheConfig;
use Prism\Core\Data\Niche\PetFoodConfig;
use Prism\Core\Data\Niche\SupplementsConfig;
use Spatie\LaravelData\Attributes\Validation\In;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Attributes\WithoutValidation;
use Spatie\LaravelData\Data;

final class ConfigData extends Data
{
    public function __construct(
        #[Required, StringType, Min(3)]
        public readonly string $project_name,

        #[Required, StringType, In(['clinical', 'playful', 'luxury', 'organic'])]
        public readonly string $theme_preset,

        #[Required, StringType, In(['none', 'supplements', 'pet_food'])]
        public readonly string $compliance_mode,

        #[Required]
        public readonly BrandColorsData $brand_colors,

        #[Nullable, WithoutValidation]
        public readonly ?NicheConfig $niche = null,
    ) {
    }

    public static function from(mixed ...$payloads): static
    {
        $payload = $payloads[0] ?? [];

        $complianceMode = $payload['compliance_mode'] ?? 'none';
        $nichePayload = $payload['niche'] ?? [];

        // Polymorphic instantiation based on valid mode
        if (is_array($nichePayload)) {
            if ($complianceMode === 'supplements') {
                $payload['niche'] = SupplementsConfig::from($nichePayload);
            } elseif ($complianceMode === 'pet_food') {
                $payload['niche'] = PetFoodConfig::from($nichePayload);
            } else {
                $payload['niche'] = null;
            }
        }

        return parent::from($payload, ...array_slice($payloads, 1));
    }
}

