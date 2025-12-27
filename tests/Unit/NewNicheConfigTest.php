<?php

declare(strict_types=1);

use Prism\Core\Data\BrandColorsData;
use Prism\Core\Data\ConfigData;
use Prism\Core\Data\Niche\CosmeticConfig;
use Prism\Core\Data\Niche\EcoConfig;
use Prism\Core\Data\Niche\TechConfig;

test('it hydrates cosmetic niche config', function () {
    $data = ConfigData::from([
        'project_name' => 'Cosmetic Brand',
        'theme_preset' => 'luxury',
        'compliance_mode' => 'cosmetic',
        'brand_colors' => [
            'primary' => '#ffffff',
            'secondary' => '#000000',
            'accent' => '#ff00ff',
        ],
        'niche' => [
            'science_page_enabled' => true,
            'disclaimer_text' => 'Not a medical device.',
        ],
    ]);

    expect($data->niche)->toBeInstanceOf(CosmeticConfig::class);
    expect($data->niche->science_page_enabled)->toBeTrue();
    expect($data->niche->disclaimer_text)->toBe('Not a medical device.');
});

test('it hydrates eco niche config', function () {
    $data = ConfigData::from([
        'project_name' => 'Eco Brand',
        'theme_preset' => 'organic',
        'compliance_mode' => 'eco',
        'brand_colors' => [
            'primary' => '#00ff00',
            'secondary' => '#000000',
            'accent' => '#ffffff',
        ],
        'niche' => [
            'sustainability_mission' => 'Save the planet.',
            'certifications' => ['B-Corp', 'Fair Trade'],
        ],
    ]);

    expect($data->niche)->toBeInstanceOf(EcoConfig::class);
    expect($data->niche->sustainability_mission)->toBe('Save the planet.');
    expect($data->niche->certifications)->toContain('B-Corp');
});

test('it hydrates tech niche config', function () {
    $data = ConfigData::from([
        'project_name' => 'Tech Brand',
        'theme_preset' => 'clinical',
        'compliance_mode' => 'tech',
        'brand_colors' => [
            'primary' => '#0000ff',
            'secondary' => '#000000',
            'accent' => '#ffffff',
        ],
        'niche' => [
            'support_hub_enabled' => true,
            'manual_url' => 'https://example.com/manual.pdf',
        ],
    ]);

    expect($data->niche)->toBeInstanceOf(TechConfig::class);
    expect($data->niche->support_hub_enabled)->toBeTrue();
    expect($data->niche->manual_url)->toBe('https://example.com/manual.pdf');
});
