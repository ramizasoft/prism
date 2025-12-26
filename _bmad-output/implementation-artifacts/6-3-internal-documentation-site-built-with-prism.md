# Story 6.3: Internal Documentation Site (Built with Prism)

Status: ready-for-dev

<!-- Note: Validation is optional. Run validate-create-story for quality check before dev-story. -->

## Story

As a New Hire,
I want a "Getting Started" guide,
so that I can learn the Prism workflow independently.

## Acceptance Criteria

1. [ ] A new directory `docs` is created in the root of the project.
2. [ ] This directory is a valid Prism site (cloned from starter or manually setup).
3. [ ] It uses the `prism` engine to build itself (Dogfooding).
4. [ ] Content includes:
    - [ ] `installation.md`: Steps to set up the engine and starter.
    - [ ] `configuration.md`: Reference for `config.php` options.
    - [ ] `compliance.md`: Guide to Supplements and Pet Food modes.
5. [ ] The site builds successfully and renders the documentation using the Clinical preset (or a new "Docs" preset if time permits).

## Tasks / Subtasks

- [ ] Initialize Docs Site (AC: 1, 2)
  - [ ] Use `prism create:client docs` (Dogfooding Story 5.3) or manual setup.
- [ ] Write Content (AC: 4)
  - [ ] Write clear, Markdown-based documentation.
  - [ ] Use the `project-context.md` and `prd.md` as source material.
- [ ] Configure Dogfooding (AC: 3)
  - [ ] Ensure the `docs` site points to the local `../prism-engine` path in `composer.json` (symlink/repository path) so it uses the latest code.
- [ ] Build & Verify (AC: 5)
  - [ ] Run `prism build` in the `docs` folder.
  - [ ] Serve the site and verify navigation and styling.

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

{{agent_model_name_version}}

### Debug Log References

### Completion Notes List

### File List
