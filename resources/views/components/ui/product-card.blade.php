@props([
    'title' => 'Product Name',
    'price' => '$99.00',
    'image' => 'https://via.placeholder.com/320x200',
    'ctaLabel' => 'View Details',
    'ctaHref' => '#',
])

<article class="flex flex-col overflow-hidden rounded-lg border border-secondary/40 bg-white shadow-sm">
    <img class="h-48 w-full object-cover" src="{{ $image }}" alt="{{ $title }}">
    <div class="flex flex-1 flex-col gap-3 p-4">
        <div>
            <h3 class="text-lg font-semibold text-primary">{{ $title }}</h3>
            <p class="text-sm text-secondary">{{ $price }}</p>
        </div>
        <div class="text-sm text-gray-700">
            {{ $slot }}
        </div>
        <div class="mt-auto">
            <a href="{{ $ctaHref }}" class="inline-flex items-center rounded-md bg-primary px-3 py-2 text-secondary font-semibold hover:opacity-90">
                {{ $ctaLabel }}
            </a>
        </div>
    </div>
</article>

