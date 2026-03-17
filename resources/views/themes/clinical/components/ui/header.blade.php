@props([
    'logo' => 'Prism',
])

@php
    $preset = $page->prism_theme_preset ?? '';
    $isPrec = str_contains($preset, 'precision');
    $isLab = str_contains($preset, 'lab');
@endphp

<div class="mx-auto max-w-6xl px-4 py-4">
    @if($isPrec)
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div class="prec-brand text-sm">{{ $logo }}</div>
            <div class="flex items-center gap-6">
                {{ $slot }}
            </div>
        </div>
        <div class="prec-rule mt-4"></div>
    @elseif($isLab)
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div class="lab-brand text-sm">{{ $logo }}</div>
            <div class="flex items-center gap-6">
                {{ $slot }}
            </div>
        </div>
        <div class="lab-pulse mt-4"></div>
    @else
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div class="sport-brand text-sm">{{ $logo }}</div>
            <div class="flex items-center gap-6">
                {{ $slot }}
            </div>
        </div>
        <div class="sport-slice mt-4"></div>
    @endif
</div>

