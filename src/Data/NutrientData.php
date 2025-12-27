<?php

declare(strict_types=1);

namespace Prism\Core\Data;

use Spatie\LaravelData\Data;

final class NutrientData extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly ?string $amount,
        public readonly float|int|string|null $dv_percent,
        public readonly ?string $source = null,
    ) {
    }

    public function formattedDv(): string
    {
        if ($this->dv_percent === null) {
            return '†';
        }

        if (is_numeric($this->dv_percent)) {
            $normalized = (float) $this->dv_percent;
            // Remove trailing zeros and decimal point if integer
            return rtrim(rtrim(number_format($normalized, 2, '.', ''), '0'), '.') . '%';
        }

        return (string) $this->dv_percent;
    }
}
