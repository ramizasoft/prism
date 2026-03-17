@props([
    'title' => 'Rooted in nature. Built for trust.',
    'subtitle' => 'A modern organic storefront with an unmistakable point of view.',
    'ctaLabel' => 'Shop Collection',
    'ctaHref' => '#products',
])

@php
    $preset = $page->prism_theme_preset ?? '';
    $isApoth = str_contains($preset, 'apothecary');
    $isFarm = str_contains($preset, 'farmstead');
    $heroClass = $isApoth ? 'apoth-hero' : ($isFarm ? 'farm-hero' : 'organic-hero');
@endphp

<section id="hero" class="{{ $heroClass }}">
    <div class="px-6 py-12 sm:px-10 sm:py-16">
        @if($isFarm)
            <div class="grid gap-8 md:grid-cols-2 md:items-center">
                <div class="farm-heroMedia aspect-[4/3] w-full rounded-2xl border border-black/10"></div>
                <div class="space-y-5">
                    <p class="farm-badge">FromFieldToBottle</p>
                    <h1 class="text-4xl font-display font-bold sm:text-5xl">{{ $title }}</h1>
                    <p class="max-w-prose text-base opacity-90 sm:text-lg">{{ $subtitle }}</p>
                    <div class="flex flex-wrap items-center gap-3">
                        <a href="{{ $ctaHref }}" class="farm-cta inline-flex items-center justify-center">{{ $ctaLabel }}</a>
                        <a href="#footer" class="inline-flex items-center justify-center rounded-full px-4 py-3 font-semibold underline decoration-black/20 underline-offset-4 hover:decoration-black/40">SeeCompliance</a>
                    </div>
                </div>
            </div>
        @else
            <div class="grid gap-10 md:grid-cols-12 md:items-end">
                <div class="md:col-span-7 space-y-5">
                    <p class="{{ $isApoth ? 'apoth-tag' : 'organic-pill' }}">
                        {{ $isApoth ? 'SmallBatchFormulae' : 'WildHarvested' }}
                    </p>
                    <h1 class="text-4xl font-display font-bold sm:text-5xl">{{ $title }}</h1>
                    <p class="max-w-prose text-base opacity-90 sm:text-lg">{{ $subtitle }}</p>
                    <div class="flex flex-wrap items-center gap-3">
                        <a href="{{ $ctaHref }}" class="{{ $isApoth ? 'apoth-cta' : 'organic-cta' }} inline-flex items-center justify-center">{{ $ctaLabel }}</a>
                        <a href="#footer" class="inline-flex items-center justify-center rounded-full px-4 py-3 font-semibold underline decoration-black/20 underline-offset-4 hover:decoration-black/40">SeeCompliance</a>
                    </div>
                </div>
                <div class="md:col-span-5">
                    <div class="aspect-[4/5] w-full rounded-2xl border border-black/10 bg-white/40 backdrop-blur"></div>
                </div>
            </div>
        @endif
        {{ $slot }}
    </div>
</section>

