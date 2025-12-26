# Story 4.1: Automated FDA Disclaimer Injection

Status: review

<!-- Note: Validation is optional. Run validate-create-story for quality check before dev-story. -->

## Story

As a Lead Developer,
I want the FDA disclaimer to be automatically added to the footer when `supplements` mode is active,
so that I never forget this legal requirement.

## Acceptance Criteria

1. [x] A smart component `x-prism::compliance-footer` is created.
2. [x] The component injects the `ConfigData` singleton to check `compliance_mode`.
3. [x] If `compliance_mode === 'supplements'`:
    - [x] Render the standard FDA disclaimer text.
    - [x] Render the "FDA Shield" icon (simple SVG).
4. [x] If `compliance_mode === 'none'` or other, render nothing (or a standard copyright).
5. [x] The text is sourced from a `lang/en/compliance.php` file in the engine (for central updates), but overrideable via config.

## Tasks / Subtasks

- [x] Create Language File (AC: 5)
  - [x] `resources/lang/en/compliance.php`
  - [x] Key: `fda_disclaimer` => "These statements have not been evaluated..."
- [x] Create Component (AC: 1, 2, 3, 4)
  - [x] `resources/views/components/compliance-footer.blade.php`
  - [x] Logic: `@if(app(ConfigData::class)->compliance_mode === 'supplements') ... @endif`
  - [x] Use config override with lang fallback for text.
- [x] Integration (AC: 3)
  - [x] Add `<x-prism::compliance-footer />` to the `ui.footer` component created in Story 3.2.
- [x] Testing
  - [x] Create rendering tests for supplements vs none.
  - [x] Assert text appears when config is 'supplements'.
  - [x] Assert text is absent when config is 'none'.

## Dev Notes

- **Smart Component Pattern:** This component knows about the global config. It's not a "dumb" UI component.
- **Translation:** Use Laravel's localization features even if we only support English initially. It allows for text replacement without code changes.

### Project Structure Notes

- `resources/views/components/compliance-footer.blade.php`
- `resources/lang/en/compliance.php`

### References

- [Source: _bmad-output/implementation-artifacts/3-2-base-layout-ui-components.md]
- [Source: project-context.md#Business Logic & Domain Rules]

## Dev Agent Record

### Agent Model Used

gpt-5.1-codex-max

### Debug Log References

- Added compliance footer component with ConfigData check and SVG shield.
- Added lang-backed/default disclaimer with config override support; avoided Laravel helpers for Jigsaw.
- Integrated footer component into UI footer; registered component alias in TemplateLoader.
- Added feature coverage for supplements vs none modes.

### Completion Notes List

- Created language file `resources/lang/en/compliance.php` with FDA disclaimer.
- Implemented `x-prism::compliance-footer` rendering disclaimer + shield only for supplements mode.
- Integrated footer into `prism::ui.footer`.
- Tests cover supplements (shows text) and none (absent).

### File List

- resources/lang/en/compliance.php
- resources/views/components/compliance-footer.blade.php
- resources/views/components/ui/footer.blade.php
- src/Listeners/TemplateLoader.php
- tests/Feature/ComplianceFooterTest.php
- _bmad-output/implementation-artifacts/sprint-status.yaml
