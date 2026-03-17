@props([
    'title' => 'Product Name',
    'price' => '$29.00',
    'image' => 'https://via.placeholder.com/320x200',
    'ctaLabel' => 'View Details',
    'ctaHref' => '#',
])

@php
    $preset = $page->prism_theme_preset ?? '';
    $isPaws = str_contains($preset, 'paws');
    $isBoing = str_contains($preset, 'boing');
    $isThreads = str_contains($preset, 'threads');

    $cardClass = $isPaws ? 'paws-card' : ($isBoing ? 'boing-card' : 'thrd-card');
@endphp

<article class="{{ $cardClass }} flex flex-col overflow-hidden">
    <div class="relative">
        <img class="h-52 w-full object-cover" src="{{ $image }}" alt="{{ $title }}">
        <div class="absolute left-4 top-4">
            @if($isPaws)
                <span class="paws-chip">GrainFree</span>
            @elseif($isBoing)
                <span class="boing-chip">Age3Plus</span>
            @else
                <span class="thrd-tag">NewDrop</span>
            @endif
        </div>
    </div>

    <div class="flex flex-1 flex-col gap-4 p-5">
        <div class="space-y-1">
            <h3 class="text-xl font-display font-bold">{{ $title }}</h3>
            <div class="text-sm opacity-85">{{ $price }}</div>
        </div>

        @if($isPaws)
            <div class="paws-cardHeader h-2 rounded-full"></div>
        @elseif($isThreads)
            <div class="thrd-rule"></div>
        @else
            <div class="boing-stripe"></div>
        @endif

        <div class="text-sm opacity-90">
            {{ $slot }}
        </div>

        <div class="mt-auto pt-2">
            <a href="{{ $ctaHref }}" class="{{ $isPaws ? 'paws-cta' : ($isBoing ? 'boing-cta' : 'thrd-cta') }} inline-flex items-center justify-center">
                {{ $ctaLabel }}
            </a>
        </div>
    </div>
</article>

