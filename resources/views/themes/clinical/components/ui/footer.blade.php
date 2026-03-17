@php
    $preset = $page->prism_theme_preset ?? '';
    $isPrec = str_contains($preset, 'precision');
    $isLab = str_contains($preset, 'lab');
    $wrapClass = $isPrec ? 'prec-footer' : ($isLab ? 'lab-footer' : 'sport-footer');
    $titleClass = $isPrec ? 'prec-footTitle' : ($isLab ? 'lab-footTitle' : 'sport-footTitle');
@endphp

<div class="{{ $wrapClass }}">
    <div class="mx-auto max-w-6xl px-4 py-10">
        <div class="grid gap-8 md:grid-cols-12">
            <div class="md:col-span-5 space-y-3">
                <div class="{{ $titleClass }} text-lg font-display font-bold">
                    {{ $page->prism_project_name ?? 'Prism' }}
                </div>
                <p class="max-w-prose text-sm opacity-85">
                    Built for trust signals. Tuned for conversion.
                </p>
            </div>
            <div class="md:col-span-7 grid gap-6 sm:grid-cols-3 text-sm">
                <div class="space-y-2">
                    <div class="font-semibold opacity-90">Explore</div>
                    <a class="block opacity-85 hover:opacity-100 underline decoration-white/20 underline-offset-4 hover:decoration-white/40" href="#hero">Overview</a>
                    <a class="block opacity-85 hover:opacity-100 underline decoration-white/20 underline-offset-4 hover:decoration-white/40" href="#products">Products</a>
                </div>
                <div class="space-y-2">
                    <div class="font-semibold opacity-90">Trust</div>
                    <a class="block opacity-85 hover:opacity-100 underline decoration-white/20 underline-offset-4 hover:decoration-white/40" href="#footer">Compliance</a>
                </div>
                <div class="space-y-2">
                    <div class="font-semibold opacity-90">Contact</div>
                    <span class="block opacity-80">support@example.com</span>
                </div>
            </div>
        </div>

        <div class="mt-8 border-t border-white/10 pt-6">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between text-xs opacity-85">
                <div>&copy; {{ date('Y') }} {{ $page->prism_project_name ?? 'Prism' }}. All rights reserved.</div>
                <div class="flex gap-4">
                    <a class="underline decoration-white/20 underline-offset-4 hover:decoration-white/40" href="#hero">Top</a>
                    <a class="underline decoration-white/20 underline-offset-4 hover:decoration-white/40" href="#products">Products</a>
                </div>
            </div>
        </div>

        <div class="mt-8">
            <x-prism::compliance-footer />
        </div>
    </div>
</div>

