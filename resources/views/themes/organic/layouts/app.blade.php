<x-prism::layout.base :page="$page">
    <title>{{ $page->title ?? ($page->prism_project_name ?? 'Prism') }}</title>

    <div class="prism-layer min-h-screen">
        <header class="{{ str_contains(($page->prism_theme_preset ?? ''), 'apothecary') ? 'apoth-header' : (str_contains(($page->prism_theme_preset ?? ''), 'farmstead') ? 'farm-header' : 'organic-header') }} sticky top-0 z-40">
            <x-prism::ui.header logo="{{ $page->prism_project_name ?? ($page->title ?? 'Prism') }}">
                <nav class="{{ str_contains(($page->prism_theme_preset ?? ''), 'apothecary') ? 'organic-nav' : (str_contains(($page->prism_theme_preset ?? ''), 'farmstead') ? 'organic-nav' : 'organic-nav') }} flex gap-5 text-sm font-semibold">
                    <a href="#hero">Overview</a>
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

