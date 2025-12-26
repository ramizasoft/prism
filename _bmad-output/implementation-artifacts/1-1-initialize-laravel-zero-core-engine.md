# Story 1.1: Initialize Laravel Zero Core Engine

Status: review

<!-- Note: Validation is optional. Run validate-create-story for quality check before dev-story. -->

## Story

As a Lead Developer,
I want to initialize the `prism` core engine using Laravel Zero,
so that I have a modern CLI framework to manage build processes and validation.

## Acceptance Criteria

1. [x] Laravel Zero v12.x project initialized.
2. [x] Command `prism` is available in the local directory.
3. [x] Pest PHP is configured for testing.
4. [x] `spatie/laravel-data` v4.18.0 is installed for DTO support.
5. [x] Project follows the namespaced structure `Prism\Core` for engine logic.

## Tasks / Subtasks

-   [x] Initialize Laravel Zero (AC: 1)
    -   [x] Run `composer create-project laravel-zero/laravel-zero prism`
    -   [x] Rename the binary from `app` to `prism` in `composer.json`
-   [x] Install Core Dependencies (AC: 4)
    -   [x] Run `composer require spatie/laravel-data:^4.18`
-   [x] Configure Testing Environment (AC: 3)
    -   [x] Ensure Pest PHP is initialized and working
    -   [x] Add a base Arch test to ensure strict typing as per project rules
-   [x] Binary Availability (AC: 2)
    -   [x] Verify `./prism` command executes correctly

## Dev Notes

-   **Architecture Compliance:**
    -   Strict typing (`declare(strict_types=1);`) is mandatory.
    -   Use Laravel Zero 12.x features for command registration.
-   **Project Structure:**
    -   Logic should reside in `app/` but follow `Prism\Core` namespace if specified (check `composer.json`).
-   **Testing:**
    -   Use Pest PHP functional style.
    -   Implement an Arch test immediately to enforce PSR-12 and strict types.

### Project Structure Notes

-   Alignment with unified project structure:
    -   Engine logic in `app/Commands/` and `src/` (or `app/` as per Laravel Zero default).
    -   Components in `resources/views/components/`.

### References

-   [Source: _bmad-output/architecture.md#Selected Starter: Hybrid Approach (Jigsaw + Laravel Zero)]
-   [Source: project-context.md#Language-Specific Rules (PHP 8.2+)]

## Dev Agent Record

### Agent Model Used

gpt-5.1-codex-max

### Debug Log References

-   composer create-project laravel-zero/laravel-zero \_tmp-lz
-   composer require spatie/laravel-data:^4.18 -W
-   php prism list
-   php vendor/bin/pest

### Completion Notes List

-   Initialized Laravel Zero v12 scaffold, set Prism\Core namespace, and renamed binary to `prism`.
-   Installed spatie/laravel-data v4.18.0 and regenerated autoloads.
-   Configured Pest with strict-types architecture guard; all tests passing.

### File List

-   composer.json
-   composer.lock
-   prism
-   bootstrap/app.php
-   bootstrap/providers.php
-   config/app.php
-   config/commands.php
-   app/Commands/InspireCommand.php
-   app/Providers/AppServiceProvider.php
-   tests/Pest.php
-   tests/TestCase.php
-   tests/Feature/InspireCommandTest.php
-   tests/Unit/ExampleTest.php
-   tests/Architecture/StrictTypesTest.php
-   phpunit.xml.dist

### Change Log

-   2025-12-25: Initialized Laravel Zero scaffold with Prism\Core namespace, renamed binary to `prism`, installed spatie/laravel-data v4.18.0, and added strict-types Pest architecture guard.
