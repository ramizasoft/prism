@php
    $configData = app()->has(\Prism\Core\Data\ConfigData::class) ? app(\Prism\Core\Data\ConfigData::class) : null;
    $complianceMode = $configData?->compliance_mode ?? 'none';

    $override = config('compliance.fda_disclaimer');
    $langPath = dirname(__DIR__, 2) . '/lang/en/compliance.php';
    $translations = is_file($langPath) ? include $langPath : [];

    $disclaimer = $override ?? ($translations['fda_disclaimer'] ?? 'These statements have not been evaluated by the Food and Drug Administration. This product is not intended to diagnose, treat, cure, or prevent any disease.');
@endphp

@if($complianceMode === 'supplements')
    <div class="mt-6 border-t border-secondary/40 pt-4 text-sm text-secondary flex items-start gap-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-secondary" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
            <path d="M12 2 2 7v4c0 5.25 3.5 10.07 10 11 6.5-.93 10-5.75 10-11V7L12 2Zm0 2.2 7 3.5v3.3c0 4.19-2.78 7.93-7 8.7-4.22-.77-7-4.51-7-8.7V7.7l7-3.5Zm-1 4.05v5.25h2V8.25h-2Zm0 6.5v2h2v-2h-2Z"/>
        </svg>
        <p>{{ $disclaimer }}</p>
    </div>
@endif


