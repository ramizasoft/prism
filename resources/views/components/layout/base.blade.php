<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        $preset = $page->prism_theme_preset ?? 'clinical';
        $presetAsset = "resources/assets/css/presets/{$preset}.css";
        $presetHref = null;

        if (function_exists('vite')) {
            try {
                $presetHref = vite($presetAsset, '/assets/build');
            } catch (\Throwable $e) {
                // Vite manifest missing or build failed
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
</head>
<body>
{{ $slot ?? '' }}
</body>
</html>

