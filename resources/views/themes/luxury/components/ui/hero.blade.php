@props([
    'title' => 'Jewelry that feels like a secret.',
    'subtitle' => 'An editorial storefront for handmade pieces, designed to feel like a private appointment.',
    'ctaLabel' => 'View Collection',
    'ctaHref' => '#products',
])

@php
    $preset = $page->prism_theme_preset ?? '';
    $isNoir = str_contains($preset, 'noir');
    $isVelvet = str_contains($preset, 'velvet');
    $isAtelier = str_contains($preset, 'atelier');
    $heroClass = $isNoir ? 'noir-hero' : ($isVelvet ? 'velvet-hero' : 'atelier-hero');
@endphp

<section id="hero" class="{{ $heroClass }}">
    <div class="px-6 py-12 sm:px-10 sm:py-16">
        @if($isAtelier)
            <div class="grid gap-10 md:grid-cols-12 md:items-start">
                <div class="md:col-span-6 space-y-6">
                    <p class="atelier-pill">EditionStudio</p>
                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-display leading-tight">
                        {{ $title }}
                    </h1>
                    <p class="max-w-prose text-sm sm:text-base opacity-85">
                        {{ $subtitle }}
                    </p>
                    <div class="flex flex-wrap items-center gap-3">
                        <a href="{{ $ctaHref }}" class="atelier-cta">{{ $ctaLabel }}</a>
                        <a href="#footer" class="inline-flex items-center justify-center text-[0.7rem] tracking-[0.22em] uppercase underline decoration-black/15 underline-offset-4 hover:decoration-black/35">
                            AtelierDetails
                        </a>
                    </div>
                </div>
                <div class="md:col-span-6 flex items-stretch">
                    <div class="ml-auto aspect-[3/4] w-full max-w-md rounded-[1.5rem] border border-black/10 bg-gradient-to-br from-white to-[#f3f0ea]"></div>
                </div>
            </div>
        @else
            <div class="grid gap-10 md:grid-cols-12 md:items-end">
                <div class="md:col-span-7 space-y-5">
                    <p class="{{ $isNoir ? 'noir-pill' : 'velvet-pill' }}">
                        {{ $isNoir ? 'MidnightCut' : 'VelvetEditions' }}
                    </p>
                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-display leading-tight">
                        {{ $title }}
                    </h1>
                    <p class="max-w-prose text-sm sm:text-base opacity-85">
                        {{ $subtitle }}
                    </p>
                    <div class="flex flex-wrap items-center gap-3">
                        <a href="{{ $ctaHref }}" class="{{ $isNoir ? 'noir-cta' : 'velvet-cta' }}">{{ $ctaLabel }}</a>
                        <a href="#footer" class="inline-flex items-center justify-center text-[0.7rem] tracking-[0.22em] uppercase underline decoration-white/25 underline-offset-4 hover:decoration-white/45">
                            CraftGuarantee
                        </a>
                    </div>
                </div>
                <div class="md:col-span-5">
                    <div class="aspect-[4/5] w-full rounded-3xl border border-white/10 bg-white/5 backdrop-blur"></div>
                </div>
            </div>
        @endif

        {{ $slot }}
    </div>
</section>

