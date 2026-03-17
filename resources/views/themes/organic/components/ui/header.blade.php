@props([
    'logo' => 'Prism',
])

@php
    $preset = $page->prism_theme_preset ?? '';
    $isApoth = str_contains($preset, 'apothecary');
    $isFarm = str_contains($preset, 'farmstead');
@endphp

<div class="mx-auto max-w-6xl px-4 py-4">
    @if($isApoth)
        <div class="flex flex-col items-center gap-3">
            <div class="apoth-masthead text-sm">{{ $logo }}</div>
            <div class="apoth-rule w-full"></div>
            <div class="flex items-center justify-center gap-6">
                {{ $slot }}
            </div>
        </div>
    @elseif($isFarm)
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div class="farm-logo text-sm">{{ $logo }}</div>
            <div class="flex items-center gap-6">
                {{ $slot }}
            </div>
        </div>
    @else
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div class="organic-logo text-xl font-semibold">{{ $logo }}</div>
            <div class="flex items-center gap-6">
                {{ $slot }}
            </div>
        </div>
    @endif
</div>

