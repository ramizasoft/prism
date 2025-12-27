@props([
    'text' => 'GMP',
    'label' => 'GMP Certified Badge',
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
    <circle cx="32" cy="32" r="26" />
    <path d="M18 32c2.5 2.6 6.8 7.1 8.5 9l0.8 0.9L46 22" />
    <text x="32" y="54" text-anchor="middle" font-family="sans-serif" font-size="9" font-weight="700" fill="currentColor" stroke="none">{{ $text }}</text>
</svg>