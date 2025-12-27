# Story 5.1: `prism update:all` Command

Status: done

## Story

...

## Dev Agent Record

### Senior Developer Review (AI)

- **Outcome:** Approved with fixes
- **Date:** 2025-12-27
- **Findings Resolved:
    - [x] Change package name from `nsakib176/prism` to `prism/core-engine` in update command.

### Completion Notes List

- Created `update:all` command with `--dry-run`, `--file`, and `--push` options.
- Update loop: composer update, git add/commit, optional push.
- Fixed engine package name following code review.
- Verified with dry-run tests.

### File List

- app/Commands/UpdateAllCommand.php
- tests/Feature/UpdateAllCommandTest.php
- README.md
- _bmad-output/implementation-artifacts/sprint-status.yaml
- _bmad-output/implementation-artifacts/5-1-prism-update-all-command.md