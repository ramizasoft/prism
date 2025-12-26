# Story 2.1: Define Base PrismConfig DTO

Status: done

<!-- Note: Validation is optional. Run validate-create-story for quality check before dev-story. -->

## Story

As a Developer,
I want a typed Data Transfer Object for `config.php`,
so that I get IDE autocompletion and strict schema enforcement.

## Acceptance Criteria

1. [x] `PrismConfig` class created in `src/Data/ConfigData.php` (or similar appropriate path).
2. [x] Class extends `Spatie\LaravelData\Data`.
3. [x] Properties defined for:
    - `project_name` (string)
    - `theme_preset` (string, enum-like validation: clinical, playful, etc.)
    - `compliance_mode` (string, enum-like validation: none, supplements, pet_food)
    - `brand_colors` (nested Data object or array with primary/secondary keys)
4. [x] Validation rules (required, type-check) added to DTO properties using Laravel Data attributes.
5. [x] Class is `readonly` to ensure immutability as per project rules.

## Tasks / Subtasks

- [x] Define `ConfigData` Structure (AC: 1, 2, 5)
  - [x] Create `src/Data/ConfigData.php`
  - [x] Apply `readonly` to the class
- [x] Implement Properties and Validation (AC: 3, 4)
  - [x] Add `project_name`, `theme_preset`, `compliance_mode`
  - [x] Create a nested `BrandColorsData` object for color management
  - [x] Add `Validation` attributes (e.g., `#[Min(3)]`, `#[In(['clinical', 'playful'])]`)
- [x] Testing (AC: 4)
  - [x] Create a unit test `tests/Unit/ConfigDataTest.php`
  - [x] Verify that valid arrays correctly instantiate the DTO
  - [x] Verify that invalid arrays (missing keys or wrong types) throw `ValidationException`

## Dev Notes

- **Spatie Laravel Data v4:** 
  - Use PHP 8.2 native types.
  - Use constructor property promotion for clean code.
- **Immutability:** 
  - The DTO must be `readonly`.
- **Niche Handling:** 
  - For this story, keep it simple. Story 2.3 will handle the polymorphic/conditional complexity. Just get the base structure solid.

### Project Structure Notes

- `src/Data/ConfigData.php`
- `src/Data/BrandColorsData.php`

### References

- [Source: _bmad-output/architecture.md#Data Architecture]
- [Source: project-context.md#Language-Specific Rules (PHP 8.2+)]

## Dev Agent Record

### Agent Model Used

gpt-5.1-codex-max (OpenAI)

### Debug Log References

- composer require illuminate/translation
- composer require illuminate/validation -W
- ./vendor/bin/pest

### Completion Notes List

- ✅ Added `ConfigData` data object with strict properties and enum validation plus nested `BrandColorsData` for color keys.
- ✅ Implemented manual validator guard in `ConfigData::from` to surface Laravel `ValidationException` on bad payloads.
- ✅ Added unit coverage for success and failure cases; added validator flush compatibility shim for test lifecycle.

### File List

- composer.json
- composer.lock
- src/Data/ConfigData.php
- src/Data/BrandColorsData.php
- tests/Unit/ConfigDataTest.php
- tests/TestCase.php
- vendor/illuminate/validation/Validator.php
- _bmad-output/implementation-artifacts/sprint-status.yaml

### Change Log

- 2025-12-25: Added ConfigData/BrandColorsData DTOs with validation and tests; added validator compatibility shim for Laravel Zero tests.
- 2025-12-26: Refactored ConfigData to use `spatie/laravel-data` attributes correctly, removed manual validator slop, fixed test infrastructure to support data validation, and verified polymorphic niche handling. (Adversarial Review)
