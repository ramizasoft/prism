@props([
    'title' => 'Product Name',
    'price' => '$99.00',
    'image' => 'https://via.placeholder.com/320x200',
    'ctaLabel' => 'View Details',
    'ctaHref' => '#',
])

@php
    $preset = $page->prism_theme_preset ?? '';
    $isPrec = str_contains($preset, 'precision');
    $isLab = str_contains($preset, 'lab');
    $cardClass = $isPrec ? 'prec-card' : ($isLab ? 'lab-card' : 'sport-card');
@endphp

<article class="{{ $cardClass }} flex flex-col overflow-hidden">
    @if($isLab)
        <div class="lab-rail" aria-hidden="true"></div>
    @elseif(! $isPrec)
        <div class="sport-rail" aria-hidden="true"></div>
    @endif

    <div class="relative">
        <img class="h-52 w-full object-cover" src="{{ $image }}" alt="{{ $title }}">
        <div class="absolute left-4 top-4">
            @if($isPrec)
                <span class="prec-chip">USPAligned</span>
            @elseif($isLab)
                <span class="lab-chip">ClinicalData</span>
            @else
                <span class="sport-chip">InformedSport</span>
            @endif
        </div>
    </div>

    <div class="flex flex-1 flex-col gap-4 p-5">
        <div class="space-y-1">
            <h3 class="text-xl font-display font-bold">{{ $title }}</h3>
            <div class="text-sm opacity-85">{{ $price }}</div>
        </div>

        @if($isPrec)
            <div class="prec-cardHeader -mx-5 px-5 py-3 text-xs font-semibold uppercase tracking-[0.18em] opacity-85">
                CapsuleCount: 60
            </div>
        @endif

        <div class="text-sm opacity-90">
            {{ $slot }}
        </div>

        <div class="mt-auto pt-2">
            <a href="{{ $ctaHref }}" class="{{ $isPrec ? 'prec-cta' : ($isLab ? 'lab-cta' : 'sport-cta') }} inline-flex items-center justify-center">
                {{ $ctaLabel }}
            </a>
        </div>
    </div>
</article>

