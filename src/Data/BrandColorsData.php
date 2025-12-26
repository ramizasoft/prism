<?php

declare(strict_types=1);

namespace Prism\Core\Data;

use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Data;

class BrandColorsData extends Data
{
    public function __construct(
        #[Required, StringType, Min(3)]
        public readonly string $primary,

        #[Required, StringType, Min(3)]
        public readonly string $secondary,
    ) {
    }
}

