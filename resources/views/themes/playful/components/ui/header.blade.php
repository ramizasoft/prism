@props([
    'logo' => 'Prism',
])

@php
    $preset = $page->prism_theme_preset ?? '';
    $isPaws = str_contains($preset, 'paws');
    $isBoing = str_contains($preset, 'boing');
    $isThreads = str_contains($preset, 'threads');
@endphp

<div class="mx-auto max-w-6xl px-4 py-4">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div class="{{ $isPaws ? 'paws-logo' : ($isBoing ? 'boing-logo' : 'thrd-logo') }} text-base sm:text-lg">
            {{ $logo }}
        </div>
        <div class="{{ $isPaws ? 'paws-nav' : ($isBoing ? 'boing-nav' : 'thrd-nav') }} flex items-center gap-6 text-xs sm:text-sm">
            {{ $slot }}
        </div>
    </div>
</div>

