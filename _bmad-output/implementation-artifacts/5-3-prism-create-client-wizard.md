# Story 5.3: `prism create:client` Wizard

Status: done

<!-- Note: Validation is optional. Run validate-create-story for quality check before dev-story. -->

## Story

As a Junior Developer,
I want a CLI wizard to scaffold a new client site,
so that I don't miss any setup steps.

## Acceptance Criteria

1. [x] A `prism create:client {name}` command is created in the engine.
2. [x] The command initiates an interactive wizard if arguments are missing.
3. [x] The wizard asks for:
    - Site Title (string)
    - Niche (choice: Clinical/Supplements, Playful/Pet, etc.)
    - Primary Color (string/hex)
4. [x] The command clones the `prism-starter` repository (URL should be configurable or hardcoded to the project repo for now).
5. [x] The command populates the `config.php` in the new directory with the answers provided.
6. [x] The command automatically runs `composer install` and `npm install` in the new directory.
7. [x] A final success message provides instructions on how to start the local preview.

## Tasks / Subtasks

- [x] Create Command (AC: 1, 2)
  - [x] `app/Commands/CreateClientCommand.php`
  - [x] Signature: `create:client {name?}`
- [x] Implement Wizard (AC: 3)
  - [x] Use `$this->ask()` for Name and Colors.
  - [x] Use `$this->choice()` for Niche.
- [x] Implement Scaffolding Logic (AC: 4, 6)
  - [x] Use `Symfony\Component\Process\Process` to run `git clone`.
  - [x] Use `Process` to run `composer install` and `npm install`.
- [x] Implement Config Population (AC: 5)
  - [x] Use `Illuminate\Filesystem\Filesystem` to read a `config.php` stub or the cloned `config.php`.
  - [x] Perform string replacements or use a template engine approach to inject variables.
- [x] Testing
  - [x] Create a feature test that mocks the interactive inputs and verifies the resulting directory structure and `config.php` content.

## Dev Notes

- **Starter Repo URL:** Since the starter repo (Story 6.1) might not be live yet, use a local path or a placeholder git URL that can be easily updated.
- **Error Handling:** If `git clone` or `composer install` fails, the command should clean up the created directory and report the error.
- **Config Stub:** It's cleaner to have a `config.php.stub` in the engine's `stubs` directory than to regex-replace a live file.

### Project Structure Notes

- `app/Commands/CreateClientCommand.php`
- `stubs/config.php.stub`

### References

- [Source: _bmad-output/implementation-artifacts/5-1-prism-update-all-command.md]
- [Source: _bmad-output/implementation-artifacts/6-1-prism-starter-template-repository.md]

## Dev Agent Record

### Agent Model Used

{{agent_model_name_version}}

### Debug Log References

### Completion Notes List

- Implemented `prism create:client` command with interactive wizard.
- Implemented scaffolding logic (git clone, composer install, npm install) using `Process` facade.
- Implemented config population using `stubs/config.php.stub`.
- Added `tests/Feature/CreateClientCommandTest.php` with 100% pass rate.
- Verified all acceptance criteria.

### File List

- app/Commands/CreateClientCommand.php
- tests/Feature/CreateClientCommandTest.php
- stubs/config.php.stub