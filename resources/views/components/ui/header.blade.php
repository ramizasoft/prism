@props([
    'logo' => 'Prism',
])

<div class="bg-primary text-secondary">
    <div class="mx-auto flex max-w-5xl items-center justify-between px-4 py-4">
        <div class="text-lg font-semibold">
            {{ $logo }}
        </div>
        <div class="flex items-center gap-6">
            {{ $slot }}
        </div>
    </div>
</div>

