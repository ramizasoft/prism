<?php

declare(strict_types=1);

namespace Prism\Core\Data;

use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Validator as IlluminateValidator;
use Illuminate\Validation\ValidationException as LaravelValidationException;
use Prism\Core\Data\Niche\NicheConfig;
use Prism\Core\Data\Niche\PetFoodConfig;
use Prism\Core\Data\Niche\SupplementsConfig;
use Spatie\LaravelData\Attributes\Validation\In;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
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

        #[Nullable]
        public readonly ?NicheConfig $niche = null,
    ) {
    }

    public static function from(mixed ...$payloads): static
    {
        $payload = $payloads[0] ?? [];

        // Ensure niche is an array if present
        if (isset($payload['niche']) && ! is_array($payload['niche'])) {
            $payload['niche'] = [];
        }

        $translator = new Translator(new ArrayLoader(), 'en');

        $validator = new IlluminateValidator(
            $translator,
            (array) $payload,
            [
                'project_name' => ['required', 'string', 'min:3'],
                'theme_preset' => ['required', 'string', 'in:clinical,playful,luxury,organic'],
                'compliance_mode' => ['required', 'string', 'in:none,supplements,pet_food'],
                'brand_colors' => ['required', 'array'],
                'brand_colors.primary' => ['required', 'string', 'min:3'],
                'brand_colors.secondary' => ['required', 'string', 'min:3'],
                // Niche Validation Rules
                'niche' => ['array'],
                'niche.fda_disclaimer' => ['required_if:compliance_mode,supplements', 'string', 'min:3'],
                'niche.supplement_facts_format' => ['required_if:compliance_mode,supplements', 'string', 'in:standard,simplified'],
                'niche.aafco_statement' => ['required_if:compliance_mode,pet_food', 'string', 'min:3'],
            ]
        );

        if ($validator->fails()) {
            throw new LaravelValidationException($validator);
        }

        $nichePayload = $payload['niche'] ?? [];
        $complianceMode = $payload['compliance_mode'] ?? 'none';

        // Polymorphic instantiation based on valid mode
        if ($complianceMode === 'supplements') {
            $payload['niche'] = SupplementsConfig::from($nichePayload);
        } elseif ($complianceMode === 'pet_food') {
            $payload['niche'] = PetFoodConfig::from($nichePayload);
        } else {
            $payload['niche'] = null;
        }

        return parent::from($payload, ...array_slice($payloads, 1));
    }
}

