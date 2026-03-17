@php
    $preset = $page->prism_theme_preset ?? '';
    $isPaws = str_contains($preset, 'paws');
    $isBoing = str_contains($preset, 'boing');
    $isThreads = str_contains($preset, 'threads');
@endphp

<div class="{{ $isPaws ? 'paws-footer' : ($isBoing ? 'boing-footer' : 'thrd-footer') }}">
    <div class="mx-auto max-w-6xl px-4 py-10">
        <div class="grid gap-8 md:grid-cols-12">
            <div class="md:col-span-5 space-y-3">
                <div class="{{ $isPaws ? 'paws-footTitle' : ($isBoing ? 'boing-footTitle' : 'thrd-footTitle') }} text-xs">
                    {{ $page->prism_project_name ?? 'Prism' }}
                </div>
                <p class="max-w-prose text-xs opacity-90">
                    {{ $isPaws ? 'Gentle on tummies. Loud on shelf.' : ($isBoing ? 'Built for endless play, tuned for parents\' trust.' : 'Apparel that feels editorial — and ships like a template.') }}
                </p>
            </div>
            <div class="md:col-span-7 grid gap-6 sm:grid-cols-3 text-xs">
                <div class="space-y-2">
                    <div class="font-semibold opacity-90">Explore</div>
                    <a class="block opacity-90 hover:opacity-100 underline decoration-black/20 underline-offset-4 hover:decoration-black/40" href="#hero">Overview</a>
                    <a class="block opacity-90 hover:opacity-100 underline decoration-black/20 underline-offset-4 hover:decoration-black/40" href="#products">Products</a>
                </div>
                <div class="space-y-2">
                    <div class="font-semibold opacity-90">Trust</div>
                    <a class="block opacity-90 hover:opacity-100 underline decoration-black/20 underline-offset-4 hover:decoration-black/40" href="#footer">Compliance</a>
                </div>
                <div class="space-y-2">
                    <div class="font-semibold opacity-90">Contact</div>
                    <span class="block opacity-85">support@example.com</span>
                </div>
            </div>
        </div>

        <div class="mt-8 border-t border-black/10 pt-6">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between text-xs opacity-90">
                <div>&copy; {{ date('Y') }} {{ $page->prism_project_name ?? 'Prism' }}. All rights reserved.</div>
                <div class="flex gap-4">
                    <a class="underline decoration-black/20 underline-offset-4 hover:decoration-black/40" href="#hero">Top</a>
                    <a class="underline decoration-black/20 underline-offset-4 hover:decoration-black/40" href="#products">Products</a>
                </div>
            </div>
        </div>

        <div class="mt-8">
            <x-prism::compliance-footer />
        </div>
    </div>
</div>

