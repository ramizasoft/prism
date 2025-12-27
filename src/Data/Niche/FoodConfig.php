<?php

declare(strict_types=1);

namespace Prism\Core\Data\Niche;

use Prism\Core\Data\NutritionFactsData;
use Spatie\LaravelData\Attributes\Validation\Required;

final class FoodConfig extends NicheConfig
{
    public function __construct(
        #[Required]
        public readonly NutritionFactsData $nutrition_facts,
    ) {
    }
}
