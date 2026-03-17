@php
    $preset = $page->prism_theme_preset ?? '';
    $isClean = str_contains($preset, 'clean-minimal');
    $isKraft = str_contains($preset, 'kraft');
    $bg = $isKraft
        ? 'bg-[#2d3e2a] text-[#faf5e9]'
        : 'bg-[#1e3a2a] text-[#f5f8f4]';
@endphp

<div class="{{ $bg }}">
    <div class="mx-auto max-w-6xl px-4 py-10">
        <div class="grid gap-8 md:grid-cols-12">
            <div class="md:col-span-5 space-y-3">
                <div class="text-lg font-display font-bold">
                    {{ $page->prism_project_name ?? 'Prism' }}
                </div>
                <p class="max-w-prose text-sm opacity-90">
                    Built to match eco-forward listings while keeping compliance front and center.
                </p>
            </div>
            <div class="md:col-span-7 grid gap-6 sm:grid-cols-3 text-sm">
                <div class="space-y-2">
                    <div class="font-semibold opacity-90">Explore</div>
                    <a class="block opacity-90 hover:opacity-100 underline decoration-white/20 underline-offset-4 hover:decoration-white/40" href="#hero">WhyEco</a>
                    <a class="block opacity-90 hover:opacity-100 underline decoration-white/20 underline-offset-4 hover:decoration-white/40" href="#products">Products</a>
                </div>
                <div class="space-y-2">
                    <div class="font-semibold opacity-90">Trust</div>
                    <a class="block opacity-90 hover:opacity-100 underline decoration-white/20 underline-offset-4 hover:decoration-white/40" href="#footer">Compliance</a>
                </div>
                <div class="space-y-2">
                    <div class="font-semibold opacity-90">Contact</div>
                    <span class="block opacity-85">support@example.com</span>
                </div>
            </div>
        </div>

        <div class="mt-8 border-t border-white/10 pt-6">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between text-xs opacity-90">
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

