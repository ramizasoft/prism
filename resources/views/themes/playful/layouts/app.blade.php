<x-prism::layout.base :page="$page">
    <title>{{ $page->title ?? ($page->prism_project_name ?? 'Prism') }}</title>

    @php
        $preset = $page->prism_theme_preset ?? '';
        $isPaws = str_contains($preset, 'paws');
        $isBoing = str_contains($preset, 'boing');
        $isThreads = str_contains($preset, 'threads');
        $headerClass = $isPaws ? 'paws-header' : ($isBoing ? 'boing-header' : 'thrd-header');
    @endphp

    <div class="prism-layer min-h-screen">
        <header class="{{ $headerClass }} sticky top-0 z-40">
            <x-prism::ui.header logo="{{ $page->prism_project_name ?? ($page->title ?? 'Prism') }}">
                <nav class="flex gap-5 text-xs font-semibold sm:text-sm">
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

