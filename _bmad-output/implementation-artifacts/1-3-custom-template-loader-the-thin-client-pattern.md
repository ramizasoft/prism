# Story 1.3: Custom Template Loader (The "Thin Client" Pattern)

Status: review

<!-- Note: Validation is optional. Run validate-create-story for quality check before dev-story. -->

## Story

As a Lead Developer,
I want the engine to load Blade templates from the `vendor` package,
so that client repositories can remain "thin" and receive automatic theme updates.

## Acceptance Criteria

1. [x] A `TemplateLoader` listener is created in the engine.
2. [x] The listener injects the `prism::` namespace pointing to the engine's `resources/views` directory.
3. [x] `viewHintPaths` are updated programmatically via Jigsaw's `setConfig` method.
4. [x] A test page in a dummy client repo successfully renders a component from the engine (e.g., `<x-prism::test />`).
5. [x] The listener is registered in the build process (either via `bootstrap.php` or the `BuildCommand`).

## Tasks / Subtasks

- [x] Create `src/Listeners/TemplateLoader.php` (AC: 1)
  - [x] Implement `handle(Jigsaw $jigsaw)` method.
  - [x] Determine the absolute path to the engine's `resources/views`.
  - [x] Use `$jigsaw->setConfig` to append to `viewHintPaths`.
- [x] Create a Test Component (AC: 4)
  - [x] Create `resources/views/components/test.blade.php` in the engine.
  - [x] Content: `<div>Prism Core Component</div>`.
- [x] Integration Test (AC: 4)
  - [x] In the feature test (from 1.2), add a `bootstrap.php` to the temp client source.
  - [x] Register the `TemplateLoader` in that bootstrap file.
  - [x] Create `source/test-view.blade.php` that uses `<x-prism::test />`.
  - [x] Verify `build_local/test-view.html` contains "Prism Core Component".
- [x] Refine `BuildCommand` (AC: 5)
  - [x] Ensure the `BuildCommand` sets up the environment such that `bootstrap.php` is respected or explicitly loaded.

## Dev Notes

- **Jigsaw Config vs. Container:** 
  - Jigsaw reads `config.php` *before* `bootstrap.php`.
  - However, `beforeBuild` runs *after* config is loaded but *before* rendering. modifying config there is the correct "Hot Swap" method.
- **Path Resolution:**
  - Be careful with `__DIR__` inside the `TemplateLoader` (which is inside `src/Listeners`). You'll need to go up levels to find `resources/views`.
  - `dirname(__DIR__, 2) . '/resources/views'` is likely correct.

### Project Structure Notes

- `src/Listeners/TemplateLoader.php`
- `resources/views/components/`

### References

- [Source: _bmad-output/implementation-artifacts/1-2-integrate-jigsaw-ssg-into-engine.md]
- [Source: project-context.md#Framework-Specific Rules (Jigsaw & Laravel Zero)]

## Dev Agent Record

### Agent Model Used

gpt-5.1-codex-max (OpenAI)

### Debug Log References

- composer dump-autoload
- ./vendor/bin/pest

### Completion Notes List

- ✅ Added `TemplateLoader` listener to register the `prism::` namespace pointing at engine `resources/views` via Jigsaw config.
- ✅ Added core test component `prism::test` and wired bootstrap registration during builds.
- ✅ Refined `BuildCommand` to invoke Jigsaw with auto-prepended autoload, ensuring helper availability in Laravel Zero context.
- ✅ Feature test exercises end-to-end build from a thin client stub, asserting generated HTML includes the core component.

### File List

- composer.json
- app/Commands/BuildCommand.php
- src/Listeners/TemplateLoader.php
- resources/views/components/test.blade.php
- tests/Feature/BuildCommandTest.php

### Change Log

- 2025-12-25: Implemented TemplateLoader and core view namespace registration; added build-time bootstrap coverage and build command adjustments.
