@props([
    'title' => 'Built on proof. Designed to convert.',
    'subtitle' => 'Clinical branding that looks like it belongs on a shelf — and feels like it belongs in a lab.',
    'ctaLabel' => 'Shop Collection',
    'ctaHref' => '#products',
])

@php
    $preset = $page->prism_theme_preset ?? '';
    $isPrec = str_contains($preset, 'precision');
    $isLab = str_contains($preset, 'lab');
    $heroClass = $isPrec ? 'prec-hero' : ($isLab ? 'lab-hero' : 'sport-hero');
@endphp

<section id="hero" class="{{ $heroClass }}">
    <div class="px-6 py-12 sm:px-10 sm:py-16">
        <div class="grid gap-10 md:grid-cols-12 md:items-end">
            <div class="md:col-span-7 space-y-5">
                <p class="{{ $isPrec ? 'prec-kicker' : ($isLab ? 'lab-kicker' : 'sport-kicker') }}">
                    {{ $isPrec ? 'BatchTested' : ($isLab ? 'ResearchBacked' : 'PerformanceGrade') }}
                </p>
                <h1 class="text-4xl font-display font-bold sm:text-5xl">{{ $title }}</h1>
                <p class="max-w-prose text-base opacity-90 sm:text-lg">{{ $subtitle }}</p>
                <div class="flex flex-wrap items-center gap-3">
                    <a href="{{ $ctaHref }}" class="{{ $isPrec ? 'prec-cta' : ($isLab ? 'lab-cta' : 'sport-cta') }} inline-flex items-center justify-center">
                        {{ $ctaLabel }}
                    </a>
                    <a href="#footer" class="{{ $isPrec ? 'prec-secondaryLink' : ($isLab ? 'lab-secondaryLink' : 'sport-secondaryLink') }} inline-flex items-center justify-center px-4 py-3">
                        SeeCompliance
                    </a>
                </div>
            </div>
            <div class="md:col-span-5">
                <div class="{{ $isPrec ? 'prec-sidePanel' : ($isLab ? 'lab-sidePanel' : 'sport-sidePanel') }} aspect-[4/5] w-full"></div>
            </div>
        </div>
        {{ $slot }}
    </div>
</section>

