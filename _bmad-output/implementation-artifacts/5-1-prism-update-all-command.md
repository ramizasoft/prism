# Story 5.1: `prism update:all` Command

Status: ready-for-dev

<!-- Note: Validation is optional. Run validate-create-story for quality check before dev-story. -->

## Story

As a Lead Developer,
I want a command that updates the engine across all client folders,
so that I can apply global changes in minutes.

## Acceptance Criteria

1. [ ] A `prism update:all` command is created in the engine.
2. [ ] It accepts a `--dry-run` flag to simulate updates without executing.
3. [ ] It accepts a `--file=path/to/fleet.json` argument (defaults to `fleet.json` in CWD).
4. [ ] It validates `fleet.json` exists and contains an array of paths.
5. [ ] It iterates through each path and executes:
    - `composer update nsakib176/prism`
    - `git add composer.lock`
    - `git commit -m "chore: update prism engine"`
    - `git push` (optional via flag, default false for safety)
6. [ ] A beautiful progress bar shows status (Processing X of Y...).
7. [ ] A summary table at the end lists Success/Failure for each site.

## Tasks / Subtasks

- [ ] Create Command (AC: 1, 2, 3)
  - [ ] `app/Commands/UpdateAllCommand.php`
  - [ ] Signature: `update:all {--dry-run} {--file=fleet.json} {--push}`
- [ ] Implement Fleet Parsing (AC: 4)
  - [ ] Read JSON file, decode, validate structure (list of strings).
- [ ] Implement Update Logic (AC: 5, 6)
  - [ ] Use `Symfony\Component\Process\Process`.
  - [ ] Use `$this->output->createProgressBar()`.
  - [ ] Wrap process calls in try/catch to capture failures (e.g., git merge conflict).
- [ ] Implement Summary (AC: 7)
  - [ ] Collect results in an array `['site' => 'path', 'status' => 'Success', 'message' => '']`.
  - [ ] Display using `$this->table(['Site', 'Status', 'Message'], $rows)`.
- [ ] Testing
  - [ ] Create a temporary folder structure with 2 dummy "client" repos.
  - [ ] Mock the `Process` class or use dry-run to verify iteration logic.

## Dev Notes

- **Safety First:** The command should probably *not* push by default unless `--push` is explicitly passed.
- **Path Resolution:** Paths in `fleet.json` should be relative to the json file or absolute. Resolve them carefully.
- **Concurrency:** For MVP, sequential processing is fine. Parallel processing (via Spatie Fork or similar) is an optimization for later.

### Project Structure Notes

- `app/Commands/UpdateAllCommand.php`

### References

- [Source: project-context.md#Development Workflow Rules]
- [Source: _bmad-output/architecture.md#Infrastructure & Deployment]

## Dev Agent Record

### Agent Model Used

{{agent_model_name_version}}

### Debug Log References

### Completion Notes List

### File List
