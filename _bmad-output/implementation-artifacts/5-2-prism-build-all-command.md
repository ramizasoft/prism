# Story 5.2: `prism build:all` Command

Status: ready-for-dev

<!-- Note: Validation is optional. Run validate-create-story for quality check before dev-story. -->

## Story

As a Lead Developer,
I want to rebuild all sites in the fleet simultaneously,
so that I can verify global CSS or logic changes across different presets.

## Acceptance Criteria

1. [ ] A `prism build:all` command is created in the engine.
2. [ ] It reuses the fleet iteration logic from Story 5.1 (refactor into a trait or service if needed).
3. [ ] It runs `prism build production` (or similar build command) in each directory.
4. [ ] It captures the exit code and output of the build process.
5. [ ] If a build fails (validation error), it flags the site as Failed in the summary table.
6. [ ] It accepts a `--stop-on-failure` flag to halt immediately if a build breaks.

## Tasks / Subtasks

- [ ] Refactor Iteration Logic (AC: 2)
  - [ ] Extract the directory iteration and progress bar logic from `UpdateAllCommand` into a `FleetIterator` trait or service.
- [ ] Create Command (AC: 1, 6)
  - [ ] `app/Commands/BuildAllCommand.php`
  - [ ] Signature: `build:all {--stop-on-failure} {--file=fleet.json}`
- [ ] Implement Build Logic (AC: 3, 4, 5)
  - [ ] Execute `php ./vendor/bin/jigsaw build production` (or the wrapped `prism build` command from Story 1.2).
  - [ ] Capture `Process::getExitCode()`.
  - [ ] If code !== 0, mark as failure and capture `getErrorOutput()`.
- [ ] Testing
  - [ ] Use dummy sites. Make one have an invalid config (triggers validation error).
  - [ ] Assert the summary table shows the failure correctly.

## Dev Notes

- **Command Chaining:** This command assumes `prism` is available in the client repo. It might be safer to call the Jigsaw binary directly or the `prism` binary if it's installed globally or locally.
- **Resource Usage:** Building 50 sites might be heavy. Sequential is safer than parallel for now to avoid OOM errors.

### Project Structure Notes

- `app/Commands/BuildAllCommand.php`
- `app/Concerns/IteratesFleet.php` (suggested trait name)

### References

- [Source: _bmad-output/implementation-artifacts/5-1-prism-update-all-command.md]
- [Source: _bmad-output/implementation-artifacts/2-2-implement-build-time-config-validator.md]

## Dev Agent Record

### Agent Model Used

{{agent_model_name_version}}

### Debug Log References

### Completion Notes List

### File List
