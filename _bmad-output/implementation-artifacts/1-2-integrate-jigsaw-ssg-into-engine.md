# Story 1.2: Integrate Jigsaw SSG into Engine

Status: review

<!-- Note: Validation is optional. Run validate-create-story for quality check before dev-story. -->

## Story

As a Lead Developer,
I want to integrate Jigsaw into the Laravel Zero engine,
so that I can leverage Jigsaw's static site generation capabilities.

## Acceptance Criteria

1. [x] Jigsaw v1.8+ installed as a dependency of the core engine.
2. [x] Custom `prism build` command successfully triggers a Jigsaw build.
3. [x] Basic Jigsaw file structure (source/destination) is manageable via the engine.
4. [x] `prism build` accepts an optional `env` argument (local, production).
5. [x] Jigsaw's binary is NOT directly used; the engine wraps it.

## Tasks / Subtasks

- [x] Install Jigsaw (AC: 1)
  - [x] Run `composer require tightenco/jigsaw`
- [x] Create `BuildCommand` (AC: 2, 4)
  - [x] Create `app/Commands/BuildCommand.php`
  - [x] Implement argument parsing (e.g., `prism build production`)
  - [x] Logic to invoke Jigsaw's `build` method or process programmatically
- [x] Establish File Structure Strategy (AC: 3)
  - [x] Define where `source` and `build_local` directories live relative to the client root (current working directory)
  - [x] Ensure the command looks for `config.php` and `source/` in the CWD
- [x] Testing
  - [x] Create a feature test that runs `prism build` in a temporary directory with a dummy `source/index.md`
  - [x] Verify `build_local/index.html` is generated

## Dev Notes

- **Integration Strategy:** 
  - Do NOT assume the standard Jigsaw directory structure exists in the *engine* repo. The engine runs inside the *client* repo.
  - The `BuildCommand` must set the "base path" for Jigsaw to the current working directory (`getcwd()`).
- **Jigsaw Invocation:**
  - Investigate instantiating `TightenCo\Jigsaw\Console\BuildCommand` directly from within Laravel Zero, or use `Symfony\Component\Process\Process` to call the Jigsaw binary if tight coupling is too complex. 
  - *Preference:* Programmatic invocation if possible for better error handling, but `Process` is acceptable for MVP.
- **Pathing:**
  - Jigsaw defaults to `source` and `build_{env}`. Stick to these defaults for now to minimize friction.

### Project Structure Notes

- `app/Commands/BuildCommand.php` is the key integration point.
- Ensure `prism` can be run from *any* directory (the client root), not just the engine root.

### References

- [Source: _bmad-output/architecture.md#Starter Template Evaluation]
- [Source: project-context.md#Framework-Specific Rules (Jigsaw & Laravel Zero)]

## Dev Agent Record

### Agent Model Used

gpt-5.1-codex-max (OpenAI)

### Debug Log References

 - composer require tightenco/jigsaw
 - ./vendor/bin/pest

### Completion Notes List

- ✅ Added `build` command wrapping Jigsaw with env parsing and CWD-scoped source/build directories, selecting the appropriate Jigsaw binary per OS.
- ✅ Guarded Jigsaw helper functions with `function_exists` to prevent Laravel Zero helper collisions.
- ✅ Added feature coverage to ensure `prism build local` produces `build_local/index.html` from client root.

### File List

- composer.json
- composer.lock
- app/Commands/BuildCommand.php
- tests/Feature/BuildCommandTest.php
- vendor/tightenco/jigsaw/src/Support/helpers.php
- _bmad-output/implementation-artifacts/sprint-status.yaml

### Change Log

- 2025-12-25: Implemented Jigsaw integration via `prism build`, added helper guards, and validated build output with automated tests.
