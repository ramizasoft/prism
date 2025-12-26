<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
@php
        $configData = app()->has(\Prism\Core\Data\ConfigData::class) ? app(\Prism\Core\Data\ConfigData::class) : null;
        $preset = $configData?->theme_preset ?? 'clinical';
        $manifestPath = source_path('assets/build/manifest.json');
        $presetAsset = "resources/assets/css/presets/{$preset}.css";
        $presetHref = null;

        if (is_file($manifestPath)) {
            try {
                $presetHref = vite($presetAsset, '/assets/build');
            } catch (\Throwable $e) {
                $presetHref = null;
            }
        }
    @endphp
    @if($presetHref)
        <link rel="stylesheet" href="{{ $presetHref }}">
    @endif
    <style>
        :root {
@foreach(($page->prism_theme_vars ?? []) as $name => $value)
            {{ $name }}: {{ $value }};
@endforeach
        }
    </style>
    <title>{{ $page->title ?? 'Prism App' }}</title>
</head>
<body class="min-h-screen bg-white text-gray-900">
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
</body>
</html>

