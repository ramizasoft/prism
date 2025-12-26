# Story 2.2: Implement Build-Time Config Validator

Status: review

<!-- Note: Validation is optional. Run validate-create-story for quality check before dev-story. -->

## Story

As a Developer,
I want the build to fail if `config.php` is invalid,
so that I don't deploy broken or non-compliant sites.

## Acceptance Criteria

1. [x] A `BuildValidator` listener is created in the engine.
2. [x] The listener runs on the `beforeBuild` Jigsaw event.
3. [x] It loads the `config.php` from the client root.
4. [x] It instantiates `PrismConfig::from($configArray)`.
5. [x] If validation fails, it catches the exception and outputs a formatted error to the console.
6. [x] The build process halts (exits with non-zero code) on failure.
7. [x] On success, the valid `PrismConfig` DTO is bound to the Container as a singleton.

## Tasks / Subtasks

- [x] Create `src/Listeners/BuildValidator.php` (AC: 1, 2)
  - [x] Implement `handle(Jigsaw $jigsaw)`
  - [x] Register in `bootstrap.php` (or verify auto-discovery if implemented)
- [x] Implement Validation Logic (AC: 3, 4, 5, 6)
  - [x] Use `ConfigData::from()` (from Story 2.1)
  - [x] Wrap in try/catch block for `ValidationException`
  - [x] Use Laravel Zero's output components (or Symfony Console style) to print red error messages
  - [x] `exit(1)` or throw a hard exception to kill the build
- [x] Container Binding (AC: 7)
  - [x] `$jigsaw->app->instance(ConfigData::class, $dto)`
- [x] Testing
  - [x] Create a feature test with an invalid `config.php` (missing required fields)
  - [x] Assert the build command fails and output contains specific validation errors

## Dev Notes

- **Fail Fast:** This is the gatekeeper. It must be ruthless.
- **DX:** The error message should be helpful. e.g. "Config Error: 'brand.colors.primary' is required." not just "Array to string conversion".
- **Container Sharing:** Binding the DTO to the container here is critical for subsequent steps (Story 3.1) where Blade components will need access to it.

### Project Structure Notes

- `src/Listeners/BuildValidator.php`

### References

- [Source: _bmad-output/implementation-artifacts/2-1-define-base-prismconfig-dto.md]
- [Source: project-context.md#Critical Implementation Rules]

## Dev Agent Record

### Agent Model Used

gpt-5.1-codex-max

### Debug Log References

- `vendor/bin/pest`

### Completion Notes List

- Added `BuildValidator` listener that loads client `config.php`, primes Spatie Data config/validation dependencies in the Jigsaw container, and binds a validated `ConfigData` for downstream use.
- Validation failures emit clear console output (field-specific errors) and halt the build with a non-zero exit code.
- Validation success leaves the build pipeline intact while sharing the DTO via the container.

### File List

- src/Listeners/BuildValidator.php
- tests/Feature/BuildValidatorTest.php
- README.md
- _bmad-output/implementation-artifacts/sprint-status.yaml
- _bmad-output/implementation-artifacts/2-2-implement-build-time-config-validator.md

### Change Log

- 2025-12-26: Added build-time config validation listener with tests and README guidance; updated sprint status to review.
