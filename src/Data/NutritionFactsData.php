<?php

declare(strict_types=1);

namespace Prism\Core\Data;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

final class NutritionFactsData extends Data
{
    public function __construct(
        public readonly ?string $serving_size,
        public readonly ?string $servings_per_container,
        public readonly ?int $calories,

        // Macronutrients
        public readonly ?string $total_fat = null,
        public readonly ?string $saturated_fat = null,
        public readonly ?string $trans_fat = null,
        public readonly ?string $cholesterol = null,
        public readonly ?string $sodium = null,
        public readonly ?string $total_carbs = null,
        public readonly ?string $dietary_fiber = null,
        public readonly ?string $total_sugars = null,
        public readonly ?string $added_sugars = null,
        public readonly ?string $protein = null,

        #[DataCollectionOf(NutrientData::class)]
        public readonly DataCollection $vitamins_minerals,
    ) {
    }

    public static function from(mixed ...$payloads): static
    {
        $payload = $payloads[0] ?? [];
        if (is_object($payload) && method_exists($payload, 'toArray')) {
            $payload = $payload->toArray();
        }
        return parent::from($payload);
    }

    public function isEmpty(): bool
    {
        return empty($this->serving_size) && empty($this->calories);
    }
}
