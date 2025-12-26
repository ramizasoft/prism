@php
    $label = $attributes->get('aria-label', 'Made in USA Badge');
@endphp

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
    <path d="M12 30h40" />
    <path d="M12 36h40" />
    <path d="M12 42h40" />
    <path d="M22 18 26 26 18 26 24 30 22 38 32 32 42 38 40 30 46 26 38 26 42 18 32 22Z" />
    <text x="32" y="52" text-anchor="middle" font-size="8" font-weight="700" fill="currentColor">USA</text>
</svg>

