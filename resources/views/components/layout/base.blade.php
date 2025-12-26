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
</head>
<body>
{{ $slot ?? '' }}
</body>
</html>

