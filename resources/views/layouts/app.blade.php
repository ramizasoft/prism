<x-prism::layout.base :page="$page">
    <title>{{ $page->title ?? 'Prism App' }}</title>
    
    <div class="min-h-screen bg-white text-secondary font-sans antialiased">
        <header>
            <x-prism::ui.header logo="{{ $page->title ?? 'Prism' }}">
                <nav class="flex gap-4 text-sm font-medium">
                    <a class="text-secondary hover:underline" href="#hero">Hero</a>
                    <a class="text-secondary hover:underline" href="#products">Products</a>
                    <a class="text-secondary hover:underline" href="#footer">Footer</a>
                </nav>
            </x-prism::ui.header>
        </header>

        <main class="px-4 py-10">
            {!! $page->content !!}
        </main>

        <footer id="footer">
            <x-prism::ui.footer />
        </footer>
    </div>
</x-prism::layout.base>

