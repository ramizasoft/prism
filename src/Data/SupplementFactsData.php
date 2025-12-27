<?php

declare(strict_types=1);

namespace Prism\Core\Data;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

final class SupplementFactsData extends Data
{
    public function __construct(
        public readonly ?string $serving_size,
        public readonly ?string $servings_per_container,
        
        #[DataCollectionOf(NutrientData::class)]
        public readonly DataCollection $nutrients,
        
        #[DataCollectionOf(ProprietaryBlendData::class)]
        public readonly DataCollection $proprietary_blends,
    ) {
    }

    public static function from(mixed ...$payloads): static
    {
        $payload = $payloads[0] ?? [];
        
        // Handle Jigsaw object/collection conversion
        if (is_object($payload) && method_exists($payload, 'toArray')) {
            $payload = $payload->toArray();
        }
        
        return parent::from($payload);
    }
    
    public function isEmpty(): bool
    {
        return empty($this->serving_size) && 
               empty($this->servings_per_container) && 
               $this->nutrients->toCollection()->isEmpty() && 
               $this->proprietary_blends->toCollection()->isEmpty();
    }
}
