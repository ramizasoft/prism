@php
    $facts = $data ?? [];

    if (is_object($facts)) {
        $facts = method_exists($facts, 'toArray') ? $facts->toArray() : (array) $facts;
    }

    $servingSize = $facts['serving_size'] ?? null;
    $servingsPerContainer = $facts['servings_per_container'] ?? null;

    $normalizeList = static function (mixed $items): array {
        $normalizeItem = static function ($item): array {
            if (is_object($item)) {
                return method_exists($item, 'toArray') ? $item->toArray() : (array) $item;
            }

            return (array) $item;
        };

        return collect($items ?? [])
            ->map(fn ($item) => $normalizeItem($item))
            ->toArray();
    };

    $nutrients = $normalizeList($facts['nutrients'] ?? []);
    $proprietaryBlends = $normalizeList($facts['proprietary_blends'] ?? []);

    $formatDv = static function ($value): string {
        if ($value === null) {
            return '†';
        }

        if (is_numeric($value)) {
            $normalized = (float) $value;

            return rtrim(rtrim(number_format($normalized, 2, '.', ''), '0'), '.') . '%';
        }

        return (string) $value;
    };
@endphp

@if($servingSize || $servingsPerContainer || $nutrients || $proprietaryBlends)
    <div class="prism-supplement-facts" role="table" aria-label="Supplement Facts">
        <div class="prism-supplement-facts__header">
            <h2>Supplement Facts</h2>
        </div>

        <div class="prism-supplement-facts__serving">
            @if($servingSize)
                <div class="prism-supplement-facts__label">Serving Size</div>
                <div class="prism-supplement-facts__value">{{ $servingSize }}</div>
            @endif
            @if($servingsPerContainer)
                <div class="prism-supplement-facts__label">Servings Per Container</div>
                <div class="prism-supplement-facts__value">{{ $servingsPerContainer }}</div>
            @endif
        </div>

        <table class="prism-supplement-facts__table">
            <thead>
            <tr>
                <th scope="col" class="prism-supplement-facts__col-label" aria-label="Nutrient"> </th>
                <th scope="col" class="prism-supplement-facts__col-label">Amount Per Serving</th>
                <th scope="col" class="prism-supplement-facts__col-label">% Daily Value*</th>
            </tr>
            </thead>
            <tbody>
            @foreach($nutrients as $nutrient)
                <tr class="prism-supplement-facts__row">
                    <th scope="row" class="prism-supplement-facts__nutrient">
                        <span class="prism-supplement-facts__name">{{ $nutrient['name'] ?? '' }}</span>
                        @if(!empty($nutrient['source']))
                            <span class="prism-supplement-facts__source">({{ $nutrient['source'] }})</span>
                        @endif
                    </th>
                    <td class="prism-supplement-facts__amount">{{ $nutrient['amount'] ?? '' }}</td>
                    <td class="prism-supplement-facts__dv">{{ $formatDv($nutrient['dv_percent'] ?? null) }}</td>
                </tr>
            @endforeach

            @foreach($proprietaryBlends as $blend)
                <tr class="prism-supplement-facts__row prism-supplement-facts__row--blend">
                    <th scope="row" class="prism-supplement-facts__nutrient" colspan="2">
                        <div class="prism-supplement-facts__blend-name">{{ $blend['name'] ?? '' }}</div>
                        @if(!empty($blend['ingredients']))
                            <div class="prism-supplement-facts__ingredients">
                                @foreach($blend['ingredients'] as $ingredient)
                                    <span class="prism-supplement-facts__ingredient">{{ $ingredient }}</span>@if(! $loop->last), @endif
                                @endforeach
                            </div>
                        @endif
                    </th>
                    <td class="prism-supplement-facts__dv prism-supplement-facts__dv--placeholder">†</td>
                </tr>
                @if(!empty($blend['amount']))
                    <tr class="prism-supplement-facts__row prism-supplement-facts__row--subtle">
                        <td class="prism-supplement-facts__amount prism-supplement-facts__amount--blend" colspan="3">{{ $blend['amount'] }}</td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>

        <div class="prism-supplement-facts__footnote">
            <p>† Daily Value not established.</p>
        </div>
    </div>
@endif

