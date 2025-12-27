@props([
    'title' => 'Our Sustainability Mission',
    'subtitle' => 'Committed to a greener future through transparent sourcing and environmental stewardship.',
    'niche' => null,
])

@php
    $mission = (is_array($niche) ? ($niche['sustainability_mission'] ?? null) : ($niche?->sustainability_mission ?? null)) 
        ?? 'We are dedicated to reducing our environmental footprint by implementing sustainable practices across our entire supply chain.';
    
    $certifications = (is_array($niche) ? ($niche['certifications'] ?? []) : ($niche?->certifications ?? []));
@endphp

<section {{ $attributes->merge(['class' => 'py-16 bg-gray-50']) }}>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="mb-12">
            <h2 class="text-3xl font-extrabold text-primary sm:text-4xl">
                {{ $title }}
            </h2>
            <p class="mt-4 text-xl text-gray-600 max-w-3xl mx-auto">
                {{ $subtitle }}
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12 mb-12 border-t-4 border-primary">
            <p class="text-lg md:text-2xl text-secondary leading-relaxed italic">
                "{{ $mission }}"
            </p>
        </div>

        @if(!empty($certifications))
            <div class="mt-12">
                <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-8">Recognized Certifications</h3>
                <div class="flex flex-wrap justify-center gap-8 md:gap-16">
                    @foreach($certifications as $cert)
                        <div class="flex flex-col items-center">
                            <div class="h-16 w-16 bg-white rounded-full flex items-center justify-center shadow-md mb-3 border border-gray-100">
                                <svg class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <span class="text-sm font-bold text-gray-600 uppercase">{{ $cert }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>
