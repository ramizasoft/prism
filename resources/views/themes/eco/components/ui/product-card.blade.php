@props([
    'title' => 'Product Name',
    'price' => '$19.00',
    'image' => 'https://via.placeholder.com/320x200',
    'ctaLabel' => 'View Details',
    'ctaHref' => '#',
])

@php
    $preset = $page->prism_theme_preset ?? '';
    $isClean = str_contains($preset, 'clean-minimal');
    $isKraft = str_contains($preset, 'kraft');
    $cardClass = $isClean ? 'clean-card' : ($isKraft ? 'kraft-card' : 'clean-card');
    $pillClass = $isClean ? 'clean-pill' : ($isKraft ? 'kraft-pill' : 'clean-pill');
    $ctaClass = $isClean ? 'clean-cta' : ($isKraft ? 'kraft-cta' : 'clean-cta');
@endphp

<article class="{{ $cardClass }} flex flex-col overflow-hidden">
    <div class="relative">
        <img class="h-52 w-full object-cover" src="{{ $image }}" alt="{{ $title }}">
        <div class="absolute left-4 top-4">
            <span class="{{ $pillClass }}">
                {{ $isKraft ? 'PlasticFree' : 'PlantBased' }}
            </span>
        </div>
    </div>

    <div class="flex flex-1 flex-col gap-4 p-5">
        <div class="space-y-1">
            <h3 class="text-xl font-display font-semibold">{{ $title }}</h3>
            <div class="text-sm opacity-85">{{ $price }}</div>
        </div>

        <div class="text-sm opacity-90">
            {{ $slot }}
        </div>

        <div class="mt-auto pt-2">
            <a href="{{ $ctaHref }}" class="{{ $ctaClass }} inline-flex w-full items-center justify-center">
                {{ $ctaLabel }}
            </a>
        </div>
    </div>
</article>

