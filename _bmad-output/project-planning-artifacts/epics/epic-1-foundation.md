# EPIC-1: Engine Foundation & Core Integration

**Status:** Not Started
**Priority:** P0
**Objective:** Establish the hybrid architecture using Laravel Zero and Jigsaw, ensuring the engine can render static sites from the core package logic.

## User Stories

### STORY-1.1: Initialize Laravel Zero Core Engine
**As a** Lead Developer,
**I want** to initialize the `prism` core engine using Laravel Zero,
**so that** I have a modern CLI framework to manage build processes and validation.

**Acceptance Criteria:**
- [ ] Laravel Zero v12.x project initialized.
- [ ] Command `prism` is available in the local directory.
- [ ] Pest PHP is configured for testing.
- [ ] `spatie/laravel-data` is installed for DTO support.

---

### STORY-1.2: Integrate Jigsaw SSG into Engine
**As a** Lead Developer,
**I want** to integrate Jigsaw into the Laravel Zero engine,
**so that** I can leverage Jigsaw's static site generation capabilities.

**Acceptance Criteria:**
- [ ] Jigsaw v1.8+ installed as a dependency of the core engine.
- [ ] Custom `prism build` command successfully triggers a Jigsaw build.
- [ ] Basic Jigsaw file structure (source/destination) is manageable via the engine.

---

### STORY-1.3: Custom Template Loader (The "Thin Client" Pattern)
**As a** Lead Developer,
**I want** the engine to load Blade templates from the `vendor` package,
**so that** client repositories can remain "thin" and receive automatic theme updates.

**Acceptance Criteria:**
- [ ] Jigsaw event listener `beforeBuild` implemented.
- [ ] Blade view paths extended to include `resources/views` within the engine package.
- [ ] A test page in a client repo can successfully `@extends` a layout defined in the engine.

---

## Technical Notes (Ref: ADR-001)
- Use Laravel Service Container to share the engine path.
- Reference Jigsaw Events documentation for hooking into the build lifecycle.
