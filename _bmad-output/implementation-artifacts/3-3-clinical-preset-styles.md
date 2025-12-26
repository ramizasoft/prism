# Story 3.3: "Clinical" Preset Styles

Status: done

<!-- Note: Validation is optional. Run validate-create-story for quality check before dev-story. -->

## Story

As a Customer,
I want a professional "Clinical" look for my supplement brand,
so that my site looks trustworthy and clean.

## Acceptance Criteria

1. [x] `clinical.css` preset created in `resources/assets/css/presets/`.
2. [x] Preset defines default typography (e.g., Inter or Roboto) and spacing appropriate for healthcare.
3. [x] `vite.config.js` is updated to include `resources/assets/css/presets/clinical.css` as an entry point.
4. [x] The base layout (from Story 3.1/3.2) dynamically loads the correct preset CSS file based on `config('prism_config.theme_preset')`.
5. [x] Preset is valid CSS/Tailwind (imports base Tailwind layers if needed).

## Tasks / Subtasks

- [x] Create Preset File (AC: 1, 2)
  - [x] `resources/assets/css/presets/clinical.css`.
  - [x] Content: `@tailwind base; @tailwind components; @tailwind utilities;` plus specific overrides (e.g., `body { font-family: 'Inter', sans-serif; }`).
- [x] Configure Vite (AC: 3)
  - [x] Update `vite.config.js` `input` array to include the new preset path.
- [x] Update Layout for Dynamic Loading (AC: 4)
  - [x] In `resources/views/components/layout/base.blade.php`:
  - [x] Logic: Determine the preset name from `ConfigData`.
  - [x] Output: `<link rel="stylesheet" href="{{ vite('resources/assets/css/presets/' . $preset . '.css') }}">`.
- [x] Verify Output (AC: 5)
  - [x] Build the site with `theme_preset: clinical`.
  - [x] Check `build_local` HTML head for the correct link tag.

## Dev Notes

- **Vite Manifest:** When using `{{ vite() }}`, ensure the path matches exactly what's in `vite.config.js`.
- **Tailwind Layers:** Since each preset is an entry point, it must include the `@tailwind` directives. This means each preset is a full bundle. This is acceptable for the "Factory" pattern where a site only uses ONE preset.
- **Font Loading:** If using Google Fonts, `clinical.css` can `@import` them or the Layout component can inject the `<link>` tags. (Layout is better for performance - preconnect). For MVP, `@import` is fine, or simple system fonts.

### Project Structure Notes

- `resources/assets/css/presets/clinical.css`
- `vite.config.js`

### References

- [Source: _bmad-output/implementation-artifacts/3-1-css-variable-injection-engine.md]
- [Source: project-context.md#Framework-Specific Rules (Jigsaw & Laravel Zero)]

## Dev Agent Record

### Agent Model Used

gpt-5.1-codex-max

### Debug Log References

- Added Vite manifest entry and preset-aware layout linking to compiled CSS.
- Ensured base layout gracefully resolves preset via ConfigData and skips when manifest absent.
- Added feature coverage to assert clinical preset link renders during build.

### Completion Notes List

- Created `resources/assets/css/presets/clinical.css` with Tailwind layers and clinical typography palette defaults.
- Added `vite.config.js` entry for clinical preset outputting manifest to `source/assets/build`.
- Updated `prism::layout.base` and `prism::layouts.app` to load preset CSS based on `ConfigData::theme_preset` using `vite()`, with manifest guard.
- Feature test builds fixture with manifest to confirm link tag and theming output.

### File List

- resources/assets/css/presets/clinical.css
- vite.config.js
- resources/views/components/layout/base.blade.php
- resources/views/layouts/app.blade.php
- tests/Feature/UIComponentsTest.php
- _bmad-output/implementation-artifacts/sprint-status.yaml

### Change Log

- 2025-12-26: Created clinical preset CSS and updated Vite config/layout for dynamic theme loading.
- 2025-12-26: Refactored clinical.css to remove hardcoded variable overrides (fixing the theming breakage), added all theme presets to Vite config, and included Google Font loading for professional typography. (Adversarial Review)
