<?php

declare(strict_types=1);

namespace Prism\Core\Data\Niche;

use Spatie\LaravelData\Attributes\Validation\BooleanType;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Attributes\Validation\StringType;

final class CosmeticConfig extends NicheConfig
{
    public function __construct(
        #[BooleanType]
        public readonly bool $science_page_enabled = true,

        #[Nullable, StringType]
        public readonly ?string $disclaimer_text = null,
    ) {
    }
}
