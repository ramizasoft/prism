@props([
    'title' => 'Playful brands with serious conversion.',
    'subtitle' => 'A toybox of layouts tuned for pet food, toys, and streetwear.',
    'ctaLabel' => 'Browse Lineup',
    'ctaHref' => '#products',
])

@php
    $preset = $page->prism_theme_preset ?? '';
    $isPaws = str_contains($preset, 'paws');
    $isBoing = str_contains($preset, 'boing');
    $isThreads = str_contains($preset, 'threads');

    $heroClass = $isPaws ? 'paws-hero' : ($isBoing ? 'boing-hero' : 'thrd-hero');
@endphp

<section id="hero" class="{{ $heroClass }}">
    <div class="px-6 py-12 sm:px-10 sm:py-16">
        <div class="grid gap-10 md:grid-cols-12 md:items-end">
            <div class="md:col-span-7 space-y-5">
                @if($isPaws)
                    <p class="paws-kicker">
                        VetApproved&nbsp;&bull;&nbsp;TailWagging
                    </p>
                @elseif($isBoing)
                    <p class="boing-kicker">
                        BigPlayEnergy
                    </p>
                @else
                    <div class="space-y-3">
                        <div class="thrd-rule w-20 sm:w-28"></div>
                        <p class="text-xs font-semibold tracking-[0.25em] uppercase">
                            DropReadyCollections
                        </p>
                    </div>
                @endif
                <h1 class="text-4xl font-display font-bold sm:text-5xl">{{ $title }}</h1>
                <p class="max-w-prose text-base opacity-90 sm:text-lg">{{ $subtitle }}</p>
                <div class="flex flex-wrap items-center gap-3">
                    <a href="{{ $ctaHref }}" class="{{ $isPaws ? 'paws-cta' : ($isBoing ? 'boing-cta' : 'thrd-cta') }} inline-flex items-center justify-center">
                        {{ $ctaLabel }}
                    </a>
                    <a href="#footer" class="{{ $isPaws ? 'paws-secondaryLink' : ($isBoing ? 'boing-secondaryLink' : 'thrd-secondaryLink') }} inline-flex items-center justify-center px-4 py-3">
                        SeeCompliance
                    </a>
                </div>
            </div>
            <div class="md:col-span-5">
                @if($isPaws)
                    <div class="paws-sidePanel aspect-[4/5] w-full"></div>
                @elseif($isBoing)
                    <div class="boing-card aspect-[4/5] w-full flex items-center justify-center bg-[#fffbf0]">
                        <span class="boing-chip">BestSeller</span>
                    </div>
                @else
                    <div class="thrd-card aspect-[4/5] w-full flex items-end p-6">
                        <span class="thrd-tag">LimitedRun</span>
                    </div>
                @endif
            </div>
        </div>
        {{ $slot }}
    </div>
</section>

