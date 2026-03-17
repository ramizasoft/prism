---
extends: prism::layouts.app
title: Configuration Reference
---
# Configuration Reference

The `config.php` file is the brain of your client site. It uses a fluent API to ensure type safety and IDE autocompletion.

## Base Configuration

```php
use Prism\Core\Prism;

return Prism::configure(
    project_name: 'My Brand',
    theme_preset: 'clinical',
    compliance_mode: 'supplements',
    brand_colors: [
        'primary' => '#0a192f',
        'secondary' => '#00a79d',
    ],
    niche: [
        // ... depends on compliance_mode ...
    ],
);
```

### Options

| Key | Type | Description |
| --- | --- | --- |
| `project_name` | `string` | The brand name used across the site. |
| `theme_preset` | `string` | Visual style: `clinical`, `clinical-precision`, `clinical-lab`, `clinical-sport`, `playful`, `playful-paws`, `playful-boing`, `playful-threads`, `luxury`, `luxury-noir`, `luxury-velvet`, `luxury-atelier`, `organic`, `organic-moss`, `organic-apothecary`, `organic-farmstead`, `eco`, `eco-clean-minimal`, `eco-kraft`. |
| `compliance_mode` | `string` | Industry mode: `none`, `supplements`, `pet_food`, `cosmetic`, `eco`, `tech`, `food`. For most Amazon seller sites you’ll use `none`, `supplements`, or `pet_food`. |
| `brand_colors` | `array` | `primary` and `secondary` hex codes. |
| `niche` | `array` | Optional industry-specific settings (shape depends on `compliance_mode`). |

---

## Theme presets (what they actually do)
The `theme_preset` impacts two things during build:
- **Template overrides**: Prism swaps component implementations for certain themes (see `TemplateLoader` in the core engine).
- **Preset CSS**: the base layout tries to load a preset stylesheet via `vite(...)` based on the active preset.

Practical rule: **if you change `theme_preset`, rebuild your frontend assets** so the new preset stylesheet is present in `source/assets/build/manifest.json`.

---

## Compliance mode + `niche` payloads (validated)
Prism validates `config.php` at build time using DTOs. If required fields are missing, the build fails fast with a clear error list.

### `none` (general brands)
Use `niche: null` (or omit `niche` entirely if you’re writing the array manually):

```php
return Prism::configure(
    project_name: 'My Brand',
    theme_preset: 'luxury-noir',
    compliance_mode: 'none',
    brand_colors: [
        'primary' => '#0c0a0e',
        'secondary' => '#d4af6e',
    ],
    niche: null,
);
```

### `supplements` (FDA disclaimer + supplement facts)
Required fields:
- `niche.fda_disclaimer` (string)
- `niche.supplement_facts_format` (`standard` or `simplified`)

```php
return Prism::configure(
    project_name: 'My Supplement Brand',
    theme_preset: 'clinical-precision',
    compliance_mode: 'supplements',
    brand_colors: [
        'primary' => '#0a192f',
        'secondary' => '#00a79d',
    ],
    niche: [
        'fda_disclaimer' => 'These statements have not been evaluated by the Food and Drug Administration. This product is not intended to diagnose, treat, cure, or prevent any disease.',
        'supplement_facts_format' => 'standard',
    ],
);
```

### `pet_food` (AAFCO statement + safety messaging)
Required fields:
- `niche.aafco_statement` (string)

Optional fields:
- `niche.safety_promise` (string|null)
- `niche.ingredients_summary` (string|null)

```php
return Prism::configure(
    project_name: 'ZenPet Organics',
    theme_preset: 'playful-paws',
    compliance_mode: 'pet_food',
    brand_colors: [
        'primary' => '#4ADE80',
        'secondary' => '#0f172a',
    ],
    niche: [
        'aafco_statement' => 'This product is formulated to meet the nutritional levels established by the AAFCO Dog Food Nutrient Profiles for all life stages.',
        'safety_promise' => 'No fillers. No by-products. Third-party tested.',
        'ingredients_summary' => 'Real meat first, plus functional ingredients for digestion and skin support.',
    ],
);
```

---

## Advanced compliance modes (supported by the core DTOs)
These modes exist in the engine, but you should only enable them if your pages/components use the corresponding features.

- **`cosmetic`**: `science_page_enabled` (bool), optional `disclaimer_text`.
- **`eco`**: `sustainability_mission` (string), optional `certifications` (array).
- **`tech`**: `support_hub_enabled` (bool), optional `manual_url` and `video_guide_url` (URLs).
- **`food`**: requires a structured `nutrition_facts` payload.

If you need these modes in your Amazon-seller blueprint, add them intentionally and test the build early (Prism will fail-fast on config issues).
