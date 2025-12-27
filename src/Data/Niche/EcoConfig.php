<?php

declare(strict_types=1);

namespace Prism\Core\Data\Niche;

use Spatie\LaravelData\Attributes\Validation\ArrayType;
use Spatie\LaravelData\Attributes\Validation\StringType;

final class EcoConfig extends NicheConfig
{
    public function __construct(
        #[StringType]
        public readonly string $sustainability_mission,

        #[ArrayType]
        public readonly array $certifications = [],
    ) {
    }
}
