<?php

declare(strict_types=1);

namespace Prism\Core\Data;

use Spatie\LaravelData\Data;

final class ProprietaryBlendData extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly ?string $amount,
        /** @var string[] */
        public readonly array $ingredients,
    ) {
    }
}
