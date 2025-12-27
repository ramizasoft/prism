@props([
    'title' => 'Product Support Hub',
    'subtitle' => 'Everything you need to get the most out of your device.',
    'niche' => null,
])

@php
    $manualUrl = (is_array($niche) ? ($niche['manual_url'] ?? null) : ($niche?->manual_url ?? null));
    $videoUrl = (is_array($niche) ? ($niche['video_guide_url'] ?? null) : ($niche?->video_guide_url ?? null));
    $hubEnabled = (is_array($niche) ? ($niche['support_hub_enabled'] ?? true) : ($niche?->support_hub_enabled ?? true));
@endphp

@if($hubEnabled)
<section {{ $attributes->merge(['class' => 'py-16 bg-secondary text-white']) }}>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-extrabold sm:text-4xl text-white">
                {{ $title }}
            </h2>
            <p class="mt-4 text-xl text-gray-300">
                {{ $subtitle }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Manual Download -->
            <div class="bg-white/5 rounded-xl p-8 border border-white/10 hover:border-primary transition-colors group">
                <div class="flex items-center justify-between mb-6">
                    <div class="p-3 bg-white/10 rounded-lg group-hover:bg-primary transition-colors">
                        <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Documentation</span>
                </div>
                <h3 class="text-2xl font-bold mb-4">User Manual</h3>
                <p class="text-gray-300 mb-8">Detailed setup instructions, safety information, and troubleshooting tips in PDF format.</p>
                @if($manualUrl)
                    <a href="{{ $manualUrl }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-secondary bg-white hover:bg-gray-100 transition-colors">
                        Download Manual (PDF)
                    </a>
                @else
                    <button disabled class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-gray-400 bg-white/10 cursor-not-allowed">
                        Manual Coming Soon
                    </button>
                @endif
            </div>

            <!-- Video Guide -->
            <div class="bg-white/5 rounded-xl p-8 border border-white/10 hover:border-primary transition-colors group">
                <div class="flex items-center justify-between mb-6">
                    <div class="p-3 bg-white/10 rounded-lg group-hover:bg-primary transition-colors">
                        <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Video Tutorials</span>
                </div>
                <h3 class="text-2xl font-bold mb-4">Setup Guide</h3>
                <p class="text-gray-300 mb-8">Watch our step-by-step video guide to get your device configured and ready to use in under 5 minutes.</p>
                @if($videoUrl)
                    <a href="{{ $videoUrl }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary hover:bg-opacity-90 transition-colors">
                        Watch Setup Video
                    </a>
                @else
                    <button disabled class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-gray-400 bg-white/10 cursor-not-allowed">
                        Video Coming Soon
                    </button>
                @endif
            </div>
        </div>

        <div class="mt-12 text-center">
            <p class="text-gray-400 text-sm">Need more help? Contact our support team directly at <a href="#" class="text-primary hover:underline">support@example.com</a></p>
        </div>
    </div>
</section>
@endif
