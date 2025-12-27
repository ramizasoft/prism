# Niche Presets & Compliance Modes

Prism uses a **Polymorphic Configuration** system to support diverse industries. The `compliance_mode` setting in `config.php` determines which additional data structure is required in the `niche` array.

## 1. Supplements
**Mode:** `'supplements'`
**DTO:** `SupplementsConfig`

Used for dietary supplements requiring DSHEA compliance.

```php
'compliance_mode' => 'supplements',
'niche' => [
    'supplement_facts_format' => 'standard', // or 'minimal'
    'fda_disclaimer' => 'These statements...', // Optional override
],
```

## 2. Pet Care
**Mode:** `'pet_food'`
**DTO:** `PetFoodConfig`

Used for pet treats, food, and topicals requiring AAFCO compliance and trust signals.

```php
'compliance_mode' => 'pet_food',
'niche' => [
    'aafco_statement' => 'Animal feeding tests using AAFCO procedures...', 
    'safety_promise' => 'We prioritize your pet\'s health...',
    'ingredients_summary' => 'All natural, non-GMO ingredients.',
],
```

## 3. Cosmetics & Topicals
**Mode:** `'cosmetic'`
**DTO:** `CosmeticConfig`

Used for skincare and beauty products to avoid "Medical Device" flags.

```php
'compliance_mode' => 'cosmetic',
'niche' => [
    'science_page_enabled' => true,
    'disclaimer_text' => 'This product is a cosmetic...', 
],
```

## 4. Eco-Friendly & Sustainable
**Mode:** `'eco'`
**DTO:** `EcoConfig`

Used for brands prioritizing sustainability claims (Climate Pledge Friendly).

```php
'compliance_mode' => 'eco',
'niche' => [
    'sustainability_mission' => 'We are committed to zero waste...',
    'certifications' => ['B-Corp', 'Climate Pledge Friendly', 'Fair Trade'],
],
```

## 5. Technology & Gadgets
**Mode:** `'tech'`
**DTO:** `TechConfig`

Used for electronics requiring support documentation to prevent returns.

```php
'compliance_mode' => 'tech',
'niche' => [
    'support_hub_enabled' => true,
    'manual_url' => 'https://example.com/manual.pdf',
    'video_guide_url' => 'https://example.com/setup-video',
],
```

## 6. Food & Grocery
**Mode:** `'food'`
**DTO:** `FoodConfig`

Used for functional foods and beverages requiring FDA Nutrition Facts.

```php
'compliance_mode' => 'food',
'niche' => [
    'nutrition_facts' => [
        'serving_size' => '1 Bar (50g)',
        'servings_per_container' => '12',
        'calories' => 250,
        'total_fat' => '10g',
        'protein' => '20g',
        // ... see NutritionFactsData for full list
    ],
],
```
