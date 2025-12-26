@props([
    'title' => 'Build your brand fast',
    'subtitle' => 'Launch high-converting pages in minutes.',
    'ctaLabel' => 'Get Started',
    'ctaHref' => '#',
])

<section id="hero" class="bg-primary text-secondary">
    <div class="mx-auto flex max-w-5xl flex-col gap-4 px-4 py-12 sm:flex-row sm:items-center sm:justify-between">
        <div class="space-y-3">
            <h1 class="text-3xl font-bold sm:text-4xl">{{ $title }}</h1>
            <p class="text-base sm:text-lg text-secondary/90">{{ $subtitle }}</p>
            {{ $slot }}
        </div>
        <div class="flex sm:flex-col gap-3">
            <a href="{{ $ctaHref }}" class="inline-flex items-center justify-center rounded-md bg-secondary px-4 py-2 text-primary font-semibold shadow hover:opacity-90">
                {{ $ctaLabel }}
            </a>
        </div>
    </div>
</section>

