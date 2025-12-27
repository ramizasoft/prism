@props([
    'data' => null,
])

@php
    $facts = $data instanceof \Prism\Core\Data\NutritionFactsData 
        ? $data 
        : \Prism\Core\Data\NutritionFactsData::from($data ?? []);
@endphp

@if(! $facts->isEmpty())
    <div class="prism-nutrition-facts bg-white p-4 border-2 border-black inline-block font-sans text-black" style="width: 320px;">
        <h2 class="text-2xl font-black border-b-8 border-black pb-1 uppercase leading-none">Nutrition Facts</h2>
        
        <div class="border-b border-black py-1">
            <div class="flex justify-between font-bold">
                <span>{{ $facts->servings_per_container ?? '0' }} servings per container</span>
            </div>
            <div class="flex justify-between font-extrabold text-lg">
                <span>Serving size</span>
                <span>{{ $facts->serving_size ?? '0' }}</span>
            </div>
        </div>

        <div class="border-b-4 border-black py-1">
            <div class="font-extrabold text-sm">Amount per serving</div>
            <div class="flex justify-between items-baseline">
                <span class="text-3xl font-black">Calories</span>
                <span class="text-4xl font-black">{{ $facts->calories ?? '0' }}</span>
            </div>
        </div>

        <div class="text-xs border-b border-black py-1 text-right font-bold">% Daily Value*</div>

        <div class="text-sm">
            <div class="border-b border-black py-1 flex justify-between">
                <span><span class="font-bold">Total Fat</span> {{ $facts->total_fat ?? '0g' }}</span>
                <span class="font-bold"></span>
            </div>
            <div class="border-b border-black py-1 flex justify-between pl-4">
                <span>Saturated Fat {{ $facts->saturated_fat ?? '0g' }}</span>
                <span class="font-bold"></span>
            </div>
            <div class="border-b border-black py-1 flex justify-between pl-4 text-xs italic">
                <span>Trans Fat {{ $facts->trans_fat ?? '0g' }}</span>
            </div>
            <div class="border-b border-black py-1 flex justify-between">
                <span><span class="font-bold">Cholesterol</span> {{ $facts->cholesterol ?? '0mg' }}</span>
            </div>
            <div class="border-b border-black py-1 flex justify-between">
                <span><span class="font-bold">Sodium</span> {{ $facts->sodium ?? '0mg' }}</span>
            </div>
            <div class="border-b border-black py-1 flex justify-between">
                <span><span class="font-bold">Total Carbohydrate</span> {{ $facts->total_carbs ?? '0g' }}</span>
            </div>
            <div class="border-b border-black py-1 flex justify-between pl-4">
                <span>Dietary Fiber {{ $facts->dietary_fiber ?? '0g' }}</span>
            </div>
            <div class="border-b border-black py-1 flex justify-between pl-4">
                <span>Total Sugars {{ $facts->total_sugars ?? '0g' }}</span>
            </div>
            <div class="border-b border-black py-1 flex justify-between pl-8">
                <span>Includes {{ $facts->added_sugars ?? '0g' }} Added Sugars</span>
            </div>
            <div class="border-b-4 border-black py-1 flex justify-between">
                <span><span class="font-bold">Protein</span> {{ $facts->protein ?? '0g' }}</span>
            </div>
        </div>

        @if(!$facts->vitamins_minerals->toCollection()->isEmpty())
            <div class="text-sm">
                @foreach($facts->vitamins_minerals as $nutrient)
                    <div class="border-b border-black py-1 flex justify-between">
                        <span>{{ $nutrient->name }} {{ $nutrient->amount }}</span>
                        <span>{{ $nutrient->formattedDv() }}</span>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="text-[10px] leading-tight mt-2">
            * The % Daily Value (DV) tells you how much a nutrient in a serving of food contributes to a daily diet. 2,000 calories a day is used for general nutrition advice.
        </div>
    </div>
@endif
