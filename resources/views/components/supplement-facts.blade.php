@php
    // Accept raw array or pre-built DTO
    $facts = $data instanceof \Prism\Core\Data\SupplementFactsData 
        ? $data 
        : \Prism\Core\Data\SupplementFactsData::from($data ?? []);
@endphp

@if(! $facts->isEmpty())
    <div class="prism-supplement-facts" role="region" aria-label="Supplement Facts">
        <div class="prism-supplement-facts__header">
            <h2>Supplement Facts</h2>
        </div>

        <div class="prism-supplement-facts__serving">
            @if($facts->serving_size)
                <div class="prism-supplement-facts__label">Serving Size</div>
                <div class="prism-supplement-facts__value">{{ $facts->serving_size }}</div>
            @endif
            @if($facts->servings_per_container)
                <div class="prism-supplement-facts__label">Servings Per Container</div>
                <div class="prism-supplement-facts__value">{{ $facts->servings_per_container }}</div>
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
            @foreach($facts->nutrients as $nutrient)
                <tr class="prism-supplement-facts__row">
                    <th scope="row" class="prism-supplement-facts__nutrient">
                        <span class="prism-supplement-facts__name">{{ $nutrient->name }}</span>
                        @if(!empty($nutrient->source))
                            <span class="prism-supplement-facts__source">({{ $nutrient->source }})</span>
                        @endif
                    </th>
                    <td class="prism-supplement-facts__amount">{{ $nutrient->amount }}</td>
                    <td class="prism-supplement-facts__dv">{{ $nutrient->formattedDv() }}</td>
                </tr>
            @endforeach

            @foreach($facts->proprietary_blends as $blend)
                <tr class="prism-supplement-facts__row prism-supplement-facts__row--blend">
                    <th scope="row" class="prism-supplement-facts__nutrient" colspan="2">
                        <div class="flex justify-between items-baseline">
                            <span class="prism-supplement-facts__blend-name">{{ $blend->name }}</span>
                            @if(!empty($blend->amount))
                                <span class="prism-supplement-facts__blend-amount">{{ $blend->amount }}</span>
                            @endif
                        </div>
                        
                        @if(!empty($blend->ingredients))
                            <div class="prism-supplement-facts__ingredients">
                                @foreach($blend->ingredients as $ingredient)
                                    <span class="prism-supplement-facts__ingredient">{{ $ingredient }}</span>@if(! $loop->last), @endif
                                @endforeach
                            </div>
                        @endif
                    </th>
                    <td class="prism-supplement-facts__dv prism-supplement-facts__dv--placeholder">†</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="prism-supplement-facts__footnote">
            <p>* Percent Daily Values are based on a 2,000 calorie diet.</p>
            <p>† Daily Value not established.</p>
        </div>
    </div>
@endif