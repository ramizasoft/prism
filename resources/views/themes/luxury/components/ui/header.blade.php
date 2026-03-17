@props([
    'logo' => 'Prism',
])

@php
    $preset = $page->prism_theme_preset ?? '';
    $isNoir = str_contains($preset, 'noir');
    $isVelvet = str_contains($preset, 'velvet');
    $isAtelier = str_contains($preset, 'atelier');
@endphp

<div class="mx-auto max-w-6xl px-4 py-4">
    @if($isNoir)
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div class="noir-logo text-xs sm:text-sm tracking-[0.3em]">{{ $logo }}</div>
            <div class="flex items-center gap-6">
                {{ $slot }}
            </div>
        </div>
    @elseif($isVelvet)
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div class="velvet-logo text-sm sm:text-base">{{ $logo }}</div>
            <div class="flex items-center gap-6 uppercase text-[0.7rem] tracking-[0.25em]">
                {{ $slot }}
            </div>
        </div>
    @else
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div class="atelier-logo">{{ $logo }}</div>
            <div class="flex items-center gap-6 uppercase text-[0.7rem] tracking-[0.22em]">
                {{ $slot }}
            </div>
        </div>
    @endif
</div>

