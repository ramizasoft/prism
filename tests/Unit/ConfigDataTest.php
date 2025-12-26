<?php

declare(strict_types=1);

use Illuminate\Validation\ValidationException;
use Prism\Core\Data\BrandColorsData;
use Prism\Core\Data\ConfigData;
use Prism\Core\Data\Niche\PetFoodConfig;
use Prism\Core\Data\Niche\SupplementsConfig;

it('creates config data from valid array', function (): void {
    try {
        $data = ConfigData::from([
            'project_name' => 'Prism',
            'theme_preset' => 'clinical',
            'compliance_mode' => 'supplements',
            'brand_colors' => [
                'primary' => '#111111',
                'secondary' => '#eeeeee',
            ],
            'niche' => [
                'fda_disclaimer' => 'These statements...',
                'supplement_facts_format' => 'standard',
            ],
        ]);
    } catch (ValidationException $e) {
        var_dump($e->errors());
        throw $e;
    }

    expect($data)->toBeInstanceOf(ConfigData::class)
        ->and($data->brand_colors)->toBeInstanceOf(BrandColorsData::class)
        ->and($data->brand_colors->primary)->toBe('#111111')
        ->and($data->brand_colors->secondary)->toBe('#eeeeee')
        ->and($data->niche)->toBeInstanceOf(SupplementsConfig::class);
});

it('allows empty niche when compliance_mode is none', function (): void {
    $data = ConfigData::from([
        'project_name' => 'Prism',
        'theme_preset' => 'clinical',
        'compliance_mode' => 'none',
        'brand_colors' => [
            'primary' => '#111111',
            'secondary' => '#eeeeee',
        ],
    ]);

    expect($data->niche)->toBeNull();
});

it('fails validation for missing required fields', function (): void {
    expect(fn () => ConfigData::from([
        'theme_preset' => 'clinical',
        'compliance_mode' => 'none',
        'brand_colors' => [
            'primary' => '#111111',
            'secondary' => '#eeeeee',
        ],
    ]))->toThrow(ValidationException::class);
});

it('fails validation for invalid enum values', function (): void {
    expect(fn () => ConfigData::from([
        'project_name' => 'Prism',
        'theme_preset' => 'invalid',
        'compliance_mode' => 'none',
        'brand_colors' => [
            'primary' => '#111111',
            'secondary' => '#eeeeee',
        ],
    ]))->toThrow(ValidationException::class);
});

it('requires niche data when compliance_mode is supplements', function (): void {
    expect(fn () => ConfigData::from([
        'project_name' => 'Prism',
        'theme_preset' => 'clinical',
        'compliance_mode' => 'supplements',
        'brand_colors' => [
            'primary' => '#111111',
            'secondary' => '#eeeeee',
        ],
    ]))->toThrow(ValidationException::class);
});

it('creates supplements niche config with required fields', function (): void {
    $data = ConfigData::from([
        'project_name' => 'Prism',
        'theme_preset' => 'clinical',
        'compliance_mode' => 'supplements',
        'brand_colors' => [
            'primary' => '#111111',
            'secondary' => '#eeeeee',
        ],
        'niche' => [
            'fda_disclaimer' => 'These statements...',
            'supplement_facts_format' => 'standard',
        ],
    ]);

    expect($data->niche)->toBeInstanceOf(SupplementsConfig::class)
        ->and($data->niche->fda_disclaimer)->toBe('These statements...')
        ->and($data->niche->supplement_facts_format)->toBe('standard');
});

it('fails when supplements niche is missing required fields', function (): void {
    expect(fn () => ConfigData::from([
        'project_name' => 'Prism',
        'theme_preset' => 'clinical',
        'compliance_mode' => 'supplements',
        'brand_colors' => [
            'primary' => '#111111',
            'secondary' => '#eeeeee',
        ],
        'niche' => [
            'supplement_facts_format' => 'standard',
        ],
    ]))->toThrow(ValidationException::class);
});

it('creates pet food niche config when provided', function (): void {
    $data = ConfigData::from([
        'project_name' => 'Prism',
        'theme_preset' => 'organic',
        'compliance_mode' => 'pet_food',
        'brand_colors' => [
            'primary' => '#111111',
            'secondary' => '#eeeeee',
        ],
        'niche' => [
            'aafco_statement' => 'Meets AAFCO standards',
        ],
    ]);

    expect($data->niche)->toBeInstanceOf(PetFoodConfig::class)
        ->and($data->niche->aafco_statement)->toBe('Meets AAFCO standards');
});

