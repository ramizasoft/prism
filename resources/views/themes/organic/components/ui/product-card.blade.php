@props([
    'title' => 'Product Name',
    'price' => '$99.00',
    'image' => 'https://via.placeholder.com/320x200',
    'ctaLabel' => 'View Details',
    'ctaHref' => '#',
])

@php
    $preset = $page->prism_theme_preset ?? '';
    $isApoth = str_contains($preset, 'apothecary');
    $isFarm = str_contains($preset, 'farmstead');
    $cardClass = $isApoth ? 'apoth-card' : ($isFarm ? 'farm-card' : 'organic-card');
@endphp

<article class="{{ $cardClass }} flex flex-col overflow-hidden">
    <div class="relative">
        <img class="h-52 w-full object-cover" src="{{ $image }}" alt="{{ $title }}">
        <div class="absolute left-4 top-4">
            @if($isApoth)
                <span class="apoth-tag">HerbalGrade</span>
            @elseif($isFarm)
                <span class="farm-badge">HarvestedDaily</span>
            @else
                <span class="organic-pill">ColdPressed</span>
            @endif
        </div>
    </div>

    <div class="flex flex-1 flex-col gap-4 p-5">
        <div class="space-y-1">
            <h3 class="text-xl font-display font-bold">{{ $title }}</h3>
            <div class="text-sm opacity-85">{{ $price }}</div>
        </div>

        @if(! $isFarm)
            <div class="organic-divider"></div>
        @endif

        <div class="text-sm opacity-90">
            {{ $slot }}
        </div>

        <div class="mt-auto pt-2">
            <a href="{{ $ctaHref }}" class="{{ $isApoth ? 'apoth-cta' : ($isFarm ? 'farm-cta' : 'organic-cta') }} inline-flex items-center justify-center">
                {{ $ctaLabel }}
            </a>
        </div>
    </div>
</article>

