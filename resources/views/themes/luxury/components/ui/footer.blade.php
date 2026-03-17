@php
    $preset = $page->prism_theme_preset ?? '';
    $isNoir = str_contains($preset, 'noir');
    $isVelvet = str_contains($preset, 'velvet');
    $isAtelier = str_contains($preset, 'atelier');
    $bg = $isNoir
        ? 'bg-[#050509] text-[#f0e8d5]'
        : ($isVelvet
            ? 'bg-[#150914] text-[#f7e0d0]'
            : 'bg-[#f3f0ea] text-[#1c1c1e]');
@endphp

<div class="{{ $bg }}">
    <div class="mx-auto max-w-6xl px-4 py-10">
        <div class="grid gap-8 md:grid-cols-12">
            <div class="md:col-span-5 space-y-3">
                <div class="text-lg font-display font-bold tracking-[0.18em] uppercase">
                    {{ $page->prism_project_name ?? 'Prism' }}
                </div>
                <p class="max-w-prose text-sm opacity-85">
                    Handmade pieces, presented with the care of a private showroom.
                </p>
            </div>
            <div class="md:col-span-7 grid gap-6 sm:grid-cols-3 text-sm">
                <div class="space-y-2">
                    <div class="font-semibold opacity-90">Collection</div>
                    <a class="block opacity-85 hover:opacity-100 underline decoration-current/25 underline-offset-4 hover:decoration-current/45" href="#hero">Story</a>
                    <a class="block opacity-85 hover:opacity-100 underline decoration-current/25 underline-offset-4 hover:decoration-current/45" href="#products">Pieces</a>
                </div>
                <div class="space-y-2">
                    <div class="font-semibold opacity-90">Assurance</div>
                    <a class="block opacity-85 hover:opacity-100 underline decoration-current/25 underline-offset-4 hover:decoration-current/45" href="#footer">Compliance</a>
                </div>
                <div class="space-y-2">
                    <div class="font-semibold opacity-90">Contact</div>
                    <span class="block opacity-85">studio@example.com</span>
                </div>
            </div>
        </div>

        <div class="mt-8 border-t border-current/10 pt-6">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between text-xs opacity-85">
                <div>&copy; {{ date('Y') }} {{ $page->prism_project_name ?? 'Prism' }}. All rights reserved.</div>
                <div class="flex gap-4">
                    <a class="underline decoration-current/25 underline-offset-4 hover:decoration-current/45" href="#hero">Top</a>
                    <a class="underline decoration-current/25 underline-offset-4 hover:decoration-current/45" href="#products">Pieces</a>
                </div>
            </div>
        </div>

        <div class="mt-8">
            <x-prism::compliance-footer />
        </div>
    </div>
</div>

