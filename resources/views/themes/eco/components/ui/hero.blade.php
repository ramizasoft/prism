@props([
    'title' => 'Clean formulas. Clear conscience.',
    'subtitle' => 'An eco storefront that feels as fresh as the products you ship.',
    'ctaLabel' => 'View Products',
    'ctaHref' => '#products',
])

@php
    $preset = $page->prism_theme_preset ?? '';
    $isClean = str_contains($preset, 'clean-minimal');
    $isKraft = str_contains($preset, 'kraft');
    $heroClass = $isClean ? 'clean-hero' : ($isKraft ? 'kraft-hero' : 'clean-hero');
@endphp

<section id="hero" class="{{ $heroClass }}">
    <div class="px-6 py-12 sm:px-10 sm:py-16">
        @if($isKraft)
            <div class="grid gap-8 md:grid-cols-2 md:items-center">
                <div class="space-y-5">
                    <p class="kraft-pill">RefillReady</p>
                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-display leading-tight">
                        {{ $title }}
                    </h1>
                    <p class="max-w-prose text-sm sm:text-base opacity-90">
                        {{ $subtitle }}
                    </p>
                    <div class="flex flex-wrap items-center gap-3">
                        <a href="{{ $ctaHref }}" class="kraft-cta">{{ $ctaLabel }}</a>
                        <a href="#footer" class="inline-flex items-center justify-center rounded-full px-4 py-3 text-xs font-semibold underline decoration-black/25 underline-offset-4 hover:decoration-black/40">
                            PackagingDetails
                        </a>
                    </div>
                </div>
                <div class="flex items-stretch">
                    <div class="ml-auto aspect-[4/3] w-full max-w-md rounded-2xl border border-black/10 bg-gradient-to-br from-[#faf5e9] to-[#e8d2a6]"></div>
                </div>
            </div>
        @else
            <div class="grid gap-10 md:grid-cols-12 md:items-end">
                <div class="md:col-span-7 space-y-5">
                    <p class="clean-pill">
                        {{ $isClean ? 'PlantPowered' : 'EcoForward' }}
                    </p>
                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-display leading-tight">
                        {{ $title }}
                    </h1>
                    <p class="max-w-prose text-sm sm:text-base opacity-90">
                        {{ $subtitle }}
                    </p>
                    <div class="flex flex-wrap items-center gap-3">
                        <a href="{{ $ctaHref }}" class="clean-cta">{{ $ctaLabel }}</a>
                        <a href="#footer" class="inline-flex items-center justify-center rounded-full px-4 py-3 text-xs font-semibold underline decoration-black/15 underline-offset-4 hover:decoration-black/35">
                            SafetySheets
                        </a>
                    </div>
                </div>
                <div class="md:col-span-5">
                    <div class="aspect-[4/5] w-full rounded-2xl border border-black/10 bg-white/70 backdrop-blur"></div>
                </div>
            </div>
        @endif

        {{ $slot }}
    </div>
</section>

