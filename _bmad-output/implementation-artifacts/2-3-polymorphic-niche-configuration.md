# Story 2.3: Polymorphic Niche Configuration

Status: done

<!-- Note: Validation is optional. Run validate-create-story for quality check before dev-story. -->

## Story

As an Implementation Specialist,
I want the config schema to change based on the selected niche,
so that I am prompted for `supplement_facts_format` only when in `supplements` mode.

## Acceptance Criteria

1. [x] `PrismConfig` DTO accepts a polymorphic `niche_config` property.
2. [x] The `niche_config` resolves to a concrete DTO (e.g., `SupplementsConfig`, `PetFoodConfig`) based on `compliance_mode` or a `type` field.
3. [x] If `compliance_mode` is `supplements`, the validation enforces the existence of `SupplementsConfig` data.
4. [x] `SupplementsConfig` DTO requires `fda_disclaimer` and `supplement_facts_format` fields.
5. [x] Invalid niche configuration throws a clear build-time error.

## Tasks / Subtasks

- [x] Create Abstract `NicheConfig` DTO (AC: 1)
  - [x] Create `src/Data/Niche/NicheConfig.php` as an abstract class.
- [x] Create Concrete Niche DTOs (AC: 2, 4)
  - [x] Create `src/Data/Niche/SupplementsConfig.php`.
    - [x] Add `fda_disclaimer` (string, required).
    - [x] Add `supplement_facts_format` (enum: standard/simplified).
  - [x] Create `src/Data/Niche/PetFoodConfig.php`.
    - [x] Add `aafco_statement` (string, required).
- [x] Implement Polymorphism in `PrismConfig` (AC: 1, 2)
  - [x] Add `public ?NicheConfig $niche` to `ConfigData`.
  - [x] Use `#[Computed]` or custom logic in `from()` to instantiate the correct class based on `compliance_mode`. 
  - *Refinement:* Spatie Data supports `#[MapOutputName]` but mapping input based on a sibling field (`compliance_mode`) often requires a custom `from()` method or `MagicalCreation` if automatic resolution isn't possible.
  - *Decision:* Use a `static rules()` method in `ConfigData` to enforce `required_if` logic (e.g., if `compliance_mode` is `supplements`, `niche` data must match `SupplementsConfig` rules).
- [x] Testing (AC: 3, 5)
  - [x] Test that `compliance_mode: supplements` fails without `niche` data.
  - [x] Test that `niche` data with missing fields fails.
- [x] **Review Follow-ups (AI)**
  - [x] [AI-Review][High] Make DTOs `readonly`.
  - [x] [AI-Review][High] Fix validation exception type for missing niche data.
  - [x] [AI-Review][Medium] Robust normalization in `BuildValidator`.

## Dev Notes

- **Polymorphism Strategy:**
  - Since `config.php` is just an array, `ConfigData::from($array)` needs to know which class to use for the `niche` key.
  - Approach: Use `WithCast` or a custom caster if `spatie/laravel-data`'s built-in polymorphism (based on a `type` field in the data itself) is too intrusive for the user's config file.
  - *Simpler Approach:* `PrismConfig` has optional nullable fields for each niche configuration (e.g., `public ?SupplementsConfig $supplements = null;`) and a validation rule ensures the correct one is filled based on `compliance_mode`. This avoids complex polymorphism if the user just nests it under a specific key.
  - *Selected Approach:* Let's stick to the "Polymorphic" requirement but simplify implementation: The `niche` key in config holds the data, and we determine the class to cast to.

### Project Structure Notes

- `src/Data/Niche/`

### References

- [Source: _bmad-output/implementation-artifacts/2-2-implement-build-time-config-validator.md]
- [Source: project-context.md#Business Logic & Domain Rules]

## Dev Agent Record

### Agent Model Used

gpt-5.1-codex-max

### Debug Log References

- Added conditional niche validation path and normalization to avoid abstract instantiation when niche is absent.
- Adjusted strict-types architecture test to ignore generated temp fixtures.

### Completion Notes List

- Implemented abstract `NicheConfig` plus `SupplementsConfig` and `PetFoodConfig` DTOs with required fields.
- Updated `ConfigData` to conditionally validate and instantiate niche DTOs based on `compliance_mode`, keeping non-niche modes optional.
- Hardened `BuildValidator` normalization for niche input and ensured Pest suites cover niche validation cases.
- **Code Review Update:** Refactored DTOs to `readonly`, improved `ConfigData::from()` validation logic, and fixed `BuildValidator` edge cases.

### File List

- src/Data/Niche/NicheConfig.php
- src/Data/Niche/SupplementsConfig.php
- src/Data/Niche/PetFoodConfig.php
- src/Data/ConfigData.php
- src/Listeners/BuildValidator.php
- tests/Unit/ConfigDataTest.php
- tests/Architecture/StrictTypesTest.php
- _bmad-output/implementation-artifacts/sprint-status.yaml

## Change Log

- Added polymorphic niche DTOs and conditional config validation to enforce supplements/pet food requirements while keeping other modes optional.
- Updated build validation and strict-type checks; expanded tests for niche validation flows.
- **Code Review Fixes:** Enforced `readonly` architecture, fixed validation exception types, hardened input normalization.
