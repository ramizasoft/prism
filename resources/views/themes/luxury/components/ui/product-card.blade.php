@props([
    'title' => 'Piece Name',
    'price' => '$240.00',
    'image' => 'https://via.placeholder.com/320x200',
    'ctaLabel' => 'View Details',
    'ctaHref' => '#',
])

@php
    $preset = $page->prism_theme_preset ?? '';
    $isNoir = str_contains($preset, 'noir');
    $isVelvet = str_contains($preset, 'velvet');
    $isAtelier = str_contains($preset, 'atelier');
    $cardClass = $isNoir ? 'noir-card' : ($isVelvet ? 'velvet-card' : 'atelier-card');
    $pillClass = $isNoir ? 'noir-pill' : ($isVelvet ? 'velvet-pill' : 'atelier-pill');
    $ctaClass = $isNoir ? 'noir-cta' : ($isVelvet ? 'velvet-cta' : 'atelier-cta');
@endphp

<article class="{{ $cardClass }} flex flex-col overflow-hidden">
    <div class="relative">
        <img class="h-52 w-full object-cover" src="{{ $image }}" alt="{{ $title }}">
        <div class="absolute left-4 top-4">
            <span class="{{ $pillClass }}">
                {{ $isNoir ? 'LimitedCut' : ($isVelvet ? 'Handset' : 'EditionNo01') }}
            </span>
        </div>
    </div>

    <div class="flex flex-1 flex-col gap-4 p-5">
        <div class="space-y-1">
            <h3 class="text-xl font-display">{{ $title }}</h3>
            <div class="text-sm opacity-80">{{ $price }}</div>
        </div>

        <div class="text-sm opacity-85">
            {{ $slot }}
        </div>

        <div class="mt-auto pt-2">
            <a href="{{ $ctaHref }}" class="{{ $ctaClass }} inline-flex w-full items-center justify-center">
                {{ $ctaLabel }}
            </a>
        </div>
    </div>
</article>

