@props([
    'topText' => 'FDA',
    'bottomText' => 'REGISTERED',
    'label' => 'FDA Registered Facility Badge',
])

<svg {{ $attributes->merge([
    'class' => 'text-primary',
    'role' => 'img',
    'aria-label' => $label,
    'viewBox' => '0 0 64 64',
    'fill' => 'none',
    'stroke' => 'currentColor',
    'stroke-width' => '2',
    'stroke-linecap' => 'round',
    'stroke-linejoin' => 'round',
]) }}>
    <title>{{ $label }}</title>
    <path d="M32 6 10 16v14c0 11.8 8.3 22.8 22 28 13.7-5.2 22-16.2 22-28V16L32 6Z" />
    <path d="M19 30h10a7 7 0 0 1 7 7v7" />
    <path d="M19 44h17" />
    <path d="M38 24h7" />
    <path d="M38 30h10" />
    <text x="32" y="23" text-anchor="middle" font-family="sans-serif" font-size="8" font-weight="700" fill="currentColor" stroke="none">{{ $topText }}</text>
    <text x="32" y="52" text-anchor="middle" font-family="sans-serif" font-size="7" font-weight="600" fill="currentColor" stroke="none">{{ $bottomText }}</text>
</svg>