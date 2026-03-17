<x-prism::layout.base :page="$page">
    <title>{{ $page->title ?? ($page->prism_project_name ?? 'Prism') }}</title>

    <div class="prism-layer min-h-screen">
        @php
            $preset = $page->prism_theme_preset ?? '';
            $isNoir = str_contains($preset, 'noir');
            $isVelvet = str_contains($preset, 'velvet');
            $isAtelier = str_contains($preset, 'atelier');
        @endphp

        <header class="{{ $isNoir ? 'noir-header' : ($isVelvet ? 'velvet-header' : ($isAtelier ? 'atelier-header' : '')) }} sticky top-0 z-40">
            <x-prism::ui.header logo="{{ $page->prism_project_name ?? ($page->title ?? 'Prism') }}">
                <nav class="{{ $isNoir ? 'noir-nav' : ($isVelvet ? 'velvet-nav' : ($isAtelier ? 'atelier-nav' : '')) }} flex gap-5 text-sm font-semibold">
                    <a href="#hero">Collection</a>
                    <a href="#products">Pieces</a>
                    <a href="#footer">Details</a>
                </nav>
            </x-prism::ui.header>
        </header>

        <main class="mx-auto max-w-6xl px-4 py-10">
            {!! $page->content !!}
        </main>

        <footer id="footer">
            <x-prism::ui.footer />
        </footer>
    </div>
</x-prism::layout.base>

