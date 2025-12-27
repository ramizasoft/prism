@props([
    'title' => 'Our Safety Promise',
    'subtitle' => 'Because your pet deserves the highest standard of care and ingredient integrity.',
    'niche' => null,
])

@php
    $safetyPromise = (is_array($niche) ? ($niche['safety_promise'] ?? null) : ($niche?->safety_promise ?? null)) 
        ?? 'We prioritize your pet\'s health by ensuring every batch is tested for purity and formulated with veterinarian-approved ingredients.';
    
    $ingredientsSummary = (is_array($niche) ? ($niche['ingredients_summary'] ?? null) : ($niche?->ingredients_summary ?? null)) 
        ?? 'Our products are crafted with natural, non-GMO ingredients, free from artificial preservatives or harmful additives.';
@endphp

<section {{ $attributes->merge(['class' => 'py-16 bg-white border-b border-gray-100']) }}>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:flex lg:items-center lg:gap-16">
            <!-- Text Content -->
            <div class="lg:w-2/3">
                <div class="mb-8">
                    <h2 class="text-3xl font-extrabold text-primary sm:text-4xl mb-4">
                        {{ $title }}
                    </h2>
                    <p class="text-xl text-gray-500">
                        {{ $subtitle }}
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <div class="bg-gray-50 p-6 rounded-xl border-l-4 border-primary">
                        <h3 class="text-lg font-bold text-secondary mb-2">Quality Assurance</h3>
                        <p class="text-gray-600 italic">"{{ $safetyPromise }}"</p>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-xl border-l-4 border-primary">
                        <h3 class="text-lg font-bold text-secondary mb-2">Ingredient Integrity</h3>
                        <p class="text-gray-600">{{ $ingredientsSummary }}</p>
                    </div>
                </div>
            </div>

            <!-- Badge & Trust Area -->
            <div class="lg:w-1/3 mt-12 lg:mt-0 flex flex-col items-center justify-center p-8 bg-primary/5 rounded-2xl border border-primary/10">
                <x-prism::compliance.badges.vet-recommended class="w-32 h-32 mb-6" />
                <div class="text-center">
                    <p class="text-sm font-bold text-primary uppercase tracking-widest mb-2">Trusted by Professionals</p>
                    <p class="text-gray-500 text-sm">Formulated in collaboration with leading veterinarians to ensure safety and efficacy for pets of all sizes.</p>
                </div>
            </div>
        </div>
    </div>
</section>
