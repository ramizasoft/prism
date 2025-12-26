<?php

declare(strict_types=1);

namespace Prism\Core\Data\Niche;

use Spatie\LaravelData\Attributes\Validation\In;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;

final class SupplementsConfig extends NicheConfig
{
    public function __construct(
        #[Required, StringType, Min(3)]
        public readonly string $fda_disclaimer,

        #[Required, StringType, In(['standard', 'simplified'])]
        public readonly string $supplement_facts_format,
    ) {
    }
}


