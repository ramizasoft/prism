Status: done

## Story

As a New Hire,
I want a "Getting Started" guide,
so that I can learn the Prism workflow independently.

## Acceptance Criteria

1. [x] A new directory `docs` is created in the root of the project.
2. [x] This directory is a valid Prism site (cloned from starter or manually setup).
3. [x] It uses the `prism` engine to build itself (Dogfooding).
4. [x] Content includes:
    - [x] `installation.md`: Steps to set up the engine and starter.
    - [x] `configuration.md`: Reference for `config.php` options.
    - [x] `compliance.md`: Guide to Supplements and Pet Food modes.
5. [x] The site builds successfully and renders the documentation using the Clinical preset (or a new "Docs" preset if time permits).

## Tasks / Subtasks

- [x] Initialize Docs Site (AC: 1, 2)
  - [x] Use `prism create:client docs` (Dogfooding Story 5.3) or manual setup.
- [x] Write Content (AC: 4)
  - [x] Write clear, Markdown-based documentation.
  - [x] Use the `project-context.md` and `prd.md` as source material.
- [x] Configure Dogfooding (AC: 3)
  - [x] Ensure the `docs` site points to the local `../prism-engine` path in `composer.json` (symlink/repository path) so it uses the latest code.
- [x] Build & Verify (AC: 5)
  - [x] Run `prism build` in the `docs` folder.
  - [x] Serve the site and verify navigation and styling.

## Dev Notes

- **Symlinking:** To make the docs site use the local engine during development, use `composer config repositories.prism '{"type": "path", "url": "../prism-engine"}'`.
- **Theme:** Just use the Clinical preset for now. It's clean enough for docs.

### Project Structure Notes

- `docs/`

### References

- [Source: _bmad-output/prd.md]
- [Source: _bmad-output/implementation-artifacts/5-3-prism-create-client-wizard.md]

## Dev Agent Record

### Agent Model Used

Gemini 2.5 Flash

### Debug Log References

- Initialized `docs` directory by copying `prism-starter`.
- Created documentation content in `docs/source/docs/`.
- Configured `docs/composer.json` to use local engine via path repository.
- Updated `index.blade.php` with documentation navigation.
- Successfully built the site using `php prism build`.

### Completion Notes List

- Site successfully dogfoods the Prism engine.
- Documentation covers installation, configuration, and compliance.
- All acceptance criteria satisfied.

### File List

- `docs/composer.json`
- `docs/config.php`
- `docs/bootstrap.php`
- `docs/source/index.blade.php`
- `docs/source/docs/installation.md`
- `docs/source/docs/configuration.md`
- `docs/source/docs/compliance.md`
