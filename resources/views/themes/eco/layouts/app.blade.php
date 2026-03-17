<x-prism::layout.base :page="$page">
    <title>{{ $page->title ?? ($page->prism_project_name ?? 'Prism') }}</title>

    <div class="prism-layer min-h-screen">
        @php
            $preset = $page->prism_theme_preset ?? '';
            $isClean = str_contains($preset, 'clean-minimal');
            $isKraft = str_contains($preset, 'kraft');
        @endphp

        <header class="{{ $isClean ? 'clean-header' : ($isKraft ? 'kraft-header' : '') }} sticky top-0 z-40">
            <x-prism::ui.header logo="{{ $page->prism_project_name ?? ($page->title ?? 'Prism') }}">
                <nav class="{{ $isClean ? 'clean-nav' : ($isKraft ? 'kraft-nav' : '') }} flex gap-5 text-sm font-semibold">
                    <a href="#hero">WhyEco</a>
                    <a href="#products">Products</a>
                    <a href="#footer">Compliance</a>
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

