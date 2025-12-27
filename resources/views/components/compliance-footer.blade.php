@php
    /** @var \Prism\Core\Data\ConfigData $config */
    $config = app(\Prism\Core\Data\ConfigData::class);
    
    // ConfigData validation ensures 'niche' is populated if mode is 'supplements'
    // and that 'niche' will be of type SupplementsConfig which has 'fda_disclaimer'.
    $isSupplements = $config->compliance_mode === 'supplements';
    $disclaimer = $isSupplements && $config->niche instanceof \Prism\Core\Data\Niche\SupplementsConfig 
        ? $config->niche->fda_disclaimer 
        : null;
@endphp

@if($isSupplements && $disclaimer)
    <div class="mt-6 border-t border-secondary/40 pt-4 text-sm text-secondary flex items-start gap-3">
        <x-prism::compliance.badges.fda-shield class="text-secondary shrink-0" />
        <p>{{ $disclaimer }}</p>
    </div>
@endif