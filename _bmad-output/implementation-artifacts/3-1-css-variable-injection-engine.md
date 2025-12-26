# Story 3.1: CSS Variable Injection Engine

Status: review

<!-- Note: Validation is optional. Run validate-create-story for quality check before dev-story. -->

## Story

As a Designer,
I want theme colors to be controlled via CSS variables in `config.php`,
so that I can rebrand a site without touching CSS files.

## Acceptance Criteria

1. [x] A `ThemeInjector` listener is created that runs before the build.
2. [x] It reads `brand.colors` from the `ConfigData` singleton (from Story 2.2).
3. [x] It injects these colors as CSS variables (e.g., `--prism-color-primary`) into a global variable accessible by Blade.
4. [x] A core layout component (e.g., `resources/views/components/layout/base.blade.php`) renders these variables in a `<style>` block in the `<head>`.
5. [x] The engine's `tailwind.config.js` is updated to map `colors.primary` to `var(--prism-color-primary)`.
6. [x] Tests verify that changing `config.php` results in different hex codes in the generated HTML.

## Tasks / Subtasks

- [x] Tailwind Config Update (AC: 5)
  - [x] Modify `tailwind.config.js` in the engine.
  - [x] Extend `colors` with `primary: 'var(--prism-color-primary)'`, `secondary`, etc.
  - [x] Extend `fontFamily` if needed.
- [x] Create `ThemeInjector` Listener (AC: 1, 2, 3)
  - [x] Create `src/Listeners/ThemeInjector.php`.
  - [x] Logic: Get `ConfigData`, flatten colors to CSS vars array.
  - [x] Share with View: `$jigsaw->setConfig('prism_theme_vars', $varsArray)`.
- [x] Create Base Layout (AC: 4)
  - [x] Create `resources/views/components/layout/base.blade.php`.
  - [x] Iterate over `$page->prism_theme_vars` and output `:root { ... }`.
- [x] Testing (AC: 6)
  - [x] Feature test: set config color `#ff0000`, run build, assert output HTML contains `--prism-color-primary: #ff0000`.

## Dev Notes

- **Separation of Concerns:** 
  - The *Listener* prepares the data.
  - The *Component* renders the `<style>` tag.
  - The *Config* drives it all.
- **Prefixing:** Always use `--prism-` to avoid conflicts with client-added CSS.
- **Variable Mapping:** Map strictly from `BrandColorsData` keys to CSS variable names.

### Project Structure Notes

- `src/Listeners/ThemeInjector.php`
- `resources/views/components/layout/base.blade.php`

### References

- [Source: _bmad-output/implementation-artifacts/2-2-implement-build-time-config-validator.md]
- [Source: project-context.md#Framework-Specific Rules (Jigsaw & Laravel Zero)]

## Dev Agent Record

### Agent Model Used

gpt-5.1-codex-max

### Debug Log References

- Added ThemeInjector listener to expose brand colors as CSS variables to Blade.
- Registered view namespace in TemplateLoader to resolve `prism::` components during builds.
- Updated tailwind config to map theme colors to CSS variables and added base layout rendering for vars.

### Completion Notes List

- ThemeInjector now binds ConfigData-derived colors into `prism_theme_vars` for use in views.
- Base layout component renders CSS variables in `<style>` for downstream components.
- Tailwind config maps primary/secondary colors to `var(--prism-color-*)` and extends sans font stack.
- Feature test ensures config color changes appear in built HTML output.

### File List

- tailwind.config.js
- resources/views/components/layout/base.blade.php
- src/Listeners/TemplateLoader.php
- src/Listeners/ThemeInjector.php
- tests/Feature/ThemeInjectorTest.php
- _bmad-output/implementation-artifacts/sprint-status.yaml
