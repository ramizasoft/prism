@props([
    'title' => 'The Science of Efficacy',
    'subtitle' => 'Understanding topical absorption and surface-level revitalization.',
    'sections' => [],
    'niche' => null,
])

@php
    $disclaimer = (is_array($niche) ? ($niche['disclaimer_text'] ?? null) : ($niche->disclaimer_text ?? null)) 
        ?? 'This product is a cosmetic intended for topical application to improve the appearance of the skin surface. It is not intended to diagnose, treat, cure, or prevent any disease.';
@endphp

<section {{ $attributes->merge(['class' => 'py-16 bg-white']) }}>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-extrabold text-primary sm:text-4xl">
                {{ $title }}
            </h2>
            <p class="mt-4 text-xl text-gray-500">
                {{ $subtitle }}
            </p>
        </div>

        <div class="grid grid-cols-1 gap-12 lg:grid-cols-3">
            @forelse($sections as $section)
                <div class="space-y-4">
                    <div class="inline-flex items-center justify-center p-3 bg-primary rounded-md shadow-lg">
                        @if(isset($section['icon']))
                            {!! $section['icon'] !!}
                        @else
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.673.224a2 2 0 01-1.332 0l-.673-.224a6 6 0 00-3.86-.517l-2.387.477a2 2 0 00-1.022.547l-1.16 1.16a2 2 0 000 2.828l1.16 1.16a2 2 0 001.022.547l2.387.477a6 6 0 003.86-.517l.673-.224a2 2 0 011.332 0l.673.224a6 6 0 003.86.517l2.387-.477a2 2 0 001.022-.547l1.16-1.16a2 2 0 000-2.828l-1.16-1.16z" />
                            </svg>
                        @endif
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">{{ $section['title'] }}</h3>
                    <p class="text-base text-gray-500">
                        {{ $section['content'] }}
                    </p>
                </div>
            @empty
                <!-- Default Placeholder Content if none provided -->
                <div class="space-y-4">
                    <h3 class="text-lg font-medium text-gray-900">Barrier Support</h3>
                    <p class="text-base text-gray-500">Our formula works with the skin's natural lipid barrier to lock in moisture and protect against environmental stressors.</p>
                </div>
                <div class="space-y-4">
                    <h3 class="text-lg font-medium text-gray-900">Topical Absorption</h3>
                    <p class="text-base text-gray-500">Optimized molecular weight ensures that active ingredients remain on the surface where they are most effective for visual rejuvenation.</p>
                </div>
                <div class="space-y-4">
                    <h3 class="text-lg font-medium text-gray-900">Surface Texture</h3>
                    <p class="text-base text-gray-500">Regular application helps to smooth the appearance of fine lines and improve overall skin radiance.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-16 p-6 bg-gray-50 border-l-4 border-primary italic text-sm text-gray-600">
            {{ $disclaimer }}
        </div>
    </div>
</section>
