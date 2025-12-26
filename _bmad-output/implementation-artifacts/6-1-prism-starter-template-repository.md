# Story 6.1: Prism Starter Template Repository

Status: ready-for-dev

<!-- Note: Validation is optional. Run validate-create-story for quality check before dev-story. -->

## Story

As a Junior Developer,
I want a clean starter repository,
so that I can start a new client project in seconds.

## Acceptance Criteria

1. [ ] A `prism-starter` directory structure is created.
2. [ ] `composer.json` is configured to require the `prism` engine (use a placeholder or `dev-main` branch).
3. [ ] `config.php` contains all base configuration keys (from Epic 2) with inline documentation.
4. [ ] `source/index.blade.php` is included, extending the core engine layout.
5. [ ] `source/_products/example-supplement.md` is included with full front-matter (including `supplement_facts`).
6. [ ] `package.json` includes scripts for `dev`, `build`, and `preview`.
7. [ ] A `README.md` explains the "Thin Client" philosophy and how to get started.

## Tasks / Subtasks

- [ ] Initialize Directory (AC: 1)
  - [ ] Create `prism-starter` folder.
- [ ] Configure Composer (AC: 2)
  - [ ] `composer init` with `prism/starter` name.
  - [ ] Add `nsakib176/prism` to requirements.
- [ ] Create Config (AC: 3)
  - [ ] `config.php`: Include `project_name`, `theme_preset`, `compliance_mode`, etc.
  - [ ] Use comments to explain the impact of each toggle.
- [ ] Create Sample Content (AC: 4, 5)
  - [ ] `source/index.blade.php`: Simple welcome message.
  - [ ] `source/_products/example.md`: Use a realistic "Vitamin C" example.
- [ ] Create Build Scripts (AC: 6)
  - [ ] `package.json`: Map `npm run build` to `prism build production`.
- [ ] Documentation (AC: 7)
  - [ ] `README.md`: Explain why there is no `resources/views` or `app/` folder in this repo.

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

{{agent_model_name_version}}

### Debug Log References

### Completion Notes List

### File List
