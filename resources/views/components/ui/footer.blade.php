<div class="bg-secondary text-primary">
    <div class="mx-auto flex max-w-5xl flex-col gap-2 px-4 py-6 text-sm sm:flex-row sm:items-center sm:justify-between">
        <div>&copy; {{ date('Y') }} {{ $page->prism_project_name ?? 'Prism' }}. All rights reserved.</div>
        <div class="flex gap-4">
            <a class="hover:underline" href="#hero">Hero</a>
            <a class="hover:underline" href="#products">Products</a>
            <a class="hover:underline" href="#footer">Footer</a>
        </div>
    </div>
    <div class="mx-auto max-w-5xl px-4 pb-6">
        <x-prism::compliance-footer />
    </div>
</div>

