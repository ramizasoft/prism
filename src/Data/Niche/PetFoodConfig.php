<?php

declare(strict_types=1);

namespace Prism\Core\Data\Niche;

use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;

final class PetFoodConfig extends NicheConfig
{
    public function __construct(
        #[Required, StringType, Min(3)]
        public readonly string $aafco_statement,

        #[Nullable, StringType]
        public readonly ?string $safety_promise = null,

        #[Nullable, StringType]
        public readonly ?string $ingredients_summary = null,
    ) {
    }
}