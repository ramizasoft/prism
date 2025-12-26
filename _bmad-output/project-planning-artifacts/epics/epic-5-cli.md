# EPIC-5: Fleet Management CLI

**Status:** Not Started
**Priority:** P1
**Objective:** Provide the automation tools needed to manage dozens of client instances from a single terminal.

## User Stories

### STORY-5.1: `prism update:all` Command
**As a** Lead Developer,
**I want** a command that updates the engine across all client folders,
**so that** I can apply global changes in minutes.

**Acceptance Criteria:**
- [ ] Command iterates through a list of directories defined in a central `fleet.json`.
- [ ] For each directory: Runs `composer update nsakib176/prism`, `git add .`, `git commit`, and `git push`.
- [ ] CLI provides a progress bar and summary of success/failures.

---

### STORY-5.2: `prism build:all` Command
**As a** Lead Developer,
**I want** to rebuild all sites in the fleet simultaneously,
**so that** I can verify global CSS or logic changes across different presets.

**Acceptance Criteria:**
- [ ] Command triggers the Jigsaw build process for all repositories in the `fleet.json`.
- [ ] Captures and displays any build validation errors (from EPIC-2) for specific sites.

---

### STORY-5.3: `prism create:client` Wizard
**As a** Junior Developer,
**I want** a CLI wizard to scaffold a new client site,
**so that** I don't miss any setup steps.

**Acceptance Criteria:**
- [ ] Command asks for site name, niche, and primary colors.
- [ ] Clones the starter template and populates the `config.php` with the answers.
- [ ] Runs initial `composer install` and `npm install`.

---

## Technical Notes
- Use Laravel Zero's `Task` feature for beautiful CLI progress output.
- Ensure the CLI has a `--dry-run` flag for safety.
