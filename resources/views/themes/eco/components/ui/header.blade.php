@props([
    'logo' => 'Prism',
])

@php
    $preset = $page->prism_theme_preset ?? '';
    $isClean = str_contains($preset, 'clean-minimal');
    $isKraft = str_contains($preset, 'kraft');
@endphp

<div class="mx-auto max-w-6xl px-4 py-4">
    @if($isClean)
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div class="clean-logo text-xs sm:text-sm tracking-[0.22em]">{{ $logo }}</div>
            <div class="flex items-center gap-6">
                {{ $slot }}
            </div>
        </div>
    @elseif($isKraft)
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div class="kraft-logo">{{ $logo }}</div>
            <div class="flex items-center gap-6">
                {{ $slot }}
            </div>
        </div>
    @else
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div class="text-lg font-semibold tracking-wide">{{ $logo }}</div>
            <div class="flex items-center gap-6">
                {{ $slot }}
            </div>
        </div>
    @endif
</div>

