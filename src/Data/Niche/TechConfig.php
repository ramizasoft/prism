<?php

declare(strict_types=1);

namespace Prism\Core\Data\Niche;

use Spatie\LaravelData\Attributes\Validation\BooleanType;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Attributes\Validation\Url;

final class TechConfig extends NicheConfig
{
    public function __construct(
        #[BooleanType]
        public readonly bool $support_hub_enabled = true,

        #[Nullable, StringType, Url]
        public readonly ?string $manual_url = null,

        #[Nullable, StringType, Url]
        public readonly ?string $video_guide_url = null,
    ) {
    }
}
