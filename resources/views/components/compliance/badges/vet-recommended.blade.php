@props([
    'topText' => 'VET',
    'bottomText' => 'RECOMMENDED',
    'label' => 'Veterinarian Recommended Badge',
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
    <!-- Protective Shield -->
    <path d="M32 6 10 16v14c0 11.8 8.3 22.8 22 28 13.7-5.2 22-16.2 22-28V16L32 6Z" />
    
    <!-- Paw Print Icon -->
    <circle cx="23" cy="27" r="2" fill="currentColor" stroke="none" />
    <circle cx="32" cy="24" r="2" fill="currentColor" stroke="none" />
    <circle cx="41" cy="27" r="2" fill="currentColor" stroke="none" />
    <path d="M32 32c-4 0-7 2-7 5s3 5 7 5 7-2 7-5-3-5-7-5Z" fill="currentColor" stroke="none" />
    
    <text x="32" y="19" text-anchor="middle" font-family="sans-serif" font-size="7" font-weight="700" fill="currentColor" stroke="none">{{ $topText }}</text>
    <text x="32" y="52" text-anchor="middle" font-family="sans-serif" font-size="6" font-weight="600" fill="currentColor" stroke="none">{{ $bottomText }}</text>
</svg>
