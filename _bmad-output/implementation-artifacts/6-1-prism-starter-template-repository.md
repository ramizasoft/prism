Status: done

## Story

As a Junior Developer,
I want a clean starter repository,
so that I can start a new client project in seconds.

## Acceptance Criteria

1. [x] A `prism-starter` directory structure is created.
2. [x] `composer.json` is configured to require the `prism` engine (use a placeholder or `dev-main` branch).
3. [x] `config.php` contains all base configuration keys (from Epic 2) with inline documentation.
4. [x] `source/index.blade.php` is included, extending the core engine layout.
5. [x] `source/_products/example-supplement.md` is included with full front-matter (including `supplement_facts`).
6. [x] `package.json` includes scripts for `dev`, `build`, and `preview`.
7. [x] A `README.md` explains the "Thin Client" philosophy and how to get started.

## Tasks / Subtasks

- [x] Initialize Directory (AC: 1)
  - [x] Create `prism-starter` folder.
- [x] Configure Composer (AC: 2)
  - [x] `composer init` with `prism/starter` name.
  - [x] Add `nsakib176/prism` to requirements.
- [x] Create Config (AC: 3)
  - [x] `config.php`: Include `project_name`, `theme_preset`, `compliance_mode`, etc.
  - [x] Use comments to explain the impact of each toggle.
- [x] Create Sample Content (AC: 4, 5)
  - [x] `source/index.blade.php`: Simple welcome message.
  - [x] `source/_products/example.md`: Use a realistic "Vitamin C" example.
- [x] Create Build Scripts (AC: 6)
  - [x] `package.json`: Map `npm run build` to `prism build production`.
- [x] Documentation (AC: 7)
  - [x] `README.md`: Explain why there is no `resources/views` or `app/` folder in this repo.

## Dev Notes

- **The "Thin" Rule:** This repository must NOT contain any logic. Only content and configuration.
- **Gitignore:** Ensure `build_*` and `vendor` are ignored.
- **Bootstrapping:** Include a `bootstrap.php` that registers the `TemplateLoader` (Story 1.3) if the engine doesn't handle it automatically yet.

### Project Structure Notes

- `prism-starter/`

### References

- [Source: project-context.md#Project Architecture & Patterns]
- [Source: _bmad-output/architecture.md#Complete Project Directory Structure]

## Dev Agent Record

### Agent Model Used

Gemini 2.5 Flash

### Debug Log References

- Created `prism-starter` directory structure.
- Configured `composer.json` with `prism/core-engine`.
- Implemented `config.php` with industry-specific toggles.
- Created `source/index.blade.php` and `source/_products/vitamin-c.md`.
- Added `bootstrap.php` to register `BuildValidator`, `ThemeInjector`, and `TemplateLoader`.
- Added `README.md` and `.gitignore`.

### Senior Developer Review (AI)

- **Outcome:** Approved with fixes
- **Date:** 2025-12-27
- **Findings Resolved:**
    - [x] Add path repository to `composer.json` for local development.
    - [x] Update NPM scripts to use `php vendor/bin/prism` for robustness.

### Completion Notes List

- All acceptance criteria met.
- Starter repo follows the "Thin Client" philosophy strictly.
- Enhanced `bootstrap.php` ensures all engine features are active out-of-the-box.
- Fixed `composer.json` and `package.json` following code review.

### File List

- `prism-starter/composer.json`
- `prism-starter/config.php`
- `prism-starter/bootstrap.php`
- `prism-starter/package.json`
- `prism-starter/README.md`
- `prism-starter/.gitignore`
- `prism-starter/source/index.blade.php`
- `prism-starter/source/_products/vitamin-c.md`
