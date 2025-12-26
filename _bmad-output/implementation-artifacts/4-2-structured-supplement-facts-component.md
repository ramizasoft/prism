# Story 4.2: Structured Supplement Facts Component

Status: review

<!-- Note: Validation is optional. Run validate-create-story for quality check before dev-story. -->

## Story

As a Content Manager,
I want to provide supplement facts in a structured format (YAML),
so that they are rendered perfectly every time.

## Acceptance Criteria

1. [ ] Create a Blade component `x-prism::supplement-facts`.
2. [ ] Component accepts a `$data` prop (array or object) with the following schema:
    - `serving_size` (string)
    - `servings_per_container` (string)
    - `nutrients` (array of objects: `name`, `amount`, `dv_percent`, `source`)
    - `proprietary_blends` (optional array of objects: `name`, `amount`, `ingredients`)
3. [ ] Renders a legally compliant Supplement Facts panel using CSS Grid or Tables.
4. [ ] Formatting requirements (FDA-aligned):
    - [ ] Title "Supplement Facts" is bold and large.
    - [ ] Thick black lines separate main sections.
    - [ ] Hairlines separate nutrients.
    - [ ] "Amount Per Serving" and "% Daily Value" headers are bold.
    - [ ] Indentation for blend ingredients.
5. [ ] Logic handles "†" (Daily Value not established) when `dv_percent` is null.

## Tasks / Subtasks

- [x] Create Component Blade File (AC: 1, 3, 4, 5)
  - [x] `resources/views/components/supplement-facts.blade.php`
  - [x] Implement the HTML structure based on research (The "Supplement Facts" panel).
- [x] Implement CSS (AC: 4)
  - [x] Create `resources/assets/css/components/supplement-facts.css` (or include in engine's main CSS).
  - [x] Use utility classes where possible, but use scoped CSS for the strict borders and spacing.
- [x] Data Mapping Logic (AC: 2, 5)
  - [x] In the component class or Blade: Iterate over nutrients and blends.
- [x] Testing
  - [x] Create a test with a complex YAML payload.
  - [x] Assert correct rendering of nested ingredients and daily values.

## Dev Notes

- **CSS Strategy:** Use a container class `.prism-supplement-facts` to scope the specific border widths and font sizes required for FDA compliance.
- **Accessibility:** Use semantic tables (`<table>`, `<th>`, `<td>`) to ensure screen readers can navigate the facts correctly.
- **YAML Source:** The data usually comes from the product's Markdown front-matter. The engine's page parser should pass this directly to the component.

### Project Structure Notes

- `resources/views/components/supplement-facts.blade.php`
- `resources/assets/css/components/supplement-facts.css`

### References

- [Source: project-context.md#Business Logic & Domain Rules]
- [Source: _bmad-output/prd.md#Compliance Requirements]

## Dev Agent Record

### Agent Model Used

gpt-5.1-codex-max

### Debug Log References

- Removed readonly class declarations from `ConfigData` and niche DTOs to satisfy PHP inheritance rules while keeping properties immutable.
- Registered `prism::supplement-facts` component alias and ensured Jigsaw view namespace availability.
- Imported scoped CSS into `clinical` preset to keep supplement panel styling bundled with theme output.

### Completion Notes List

- Implemented FDA-styled `x-prism::supplement-facts` Blade component with table markup, DV handling (†), blend indentation, and source labels.
- Added scoped styles via `resources/assets/css/components/supplement-facts.css` and imported into clinical preset.
- Normalized prop data (arrays, objects, collections) to drive nutrient and blend rendering reliably.
- Added feature test covering nested nutrients/blends plus DV fallback.
- Updated documentation with usage and data schema for the new component.
- Fixed Spatie Data DTO inheritance compatibility by dropping readonly class modifiers while retaining readonly properties.
- Story status set to review; sprint-status updated accordingly.

### File List

- resources/views/components/supplement-facts.blade.php
- resources/assets/css/components/supplement-facts.css
- resources/assets/css/presets/clinical.css
- src/Listeners/TemplateLoader.php
- src/Data/ConfigData.php
- src/Data/Niche/NicheConfig.php
- src/Data/Niche/SupplementsConfig.php
- src/Data/Niche/PetFoodConfig.php
- tests/Feature/SupplementFactsComponentTest.php
- README.md
- _bmad-output/implementation-artifacts/sprint-status.yaml