# EPIC-2: Configuration & Build Validation

**Status:** Not Started
**Priority:** P0
**Objective:** Implement the typed configuration system using DTOs to ensure all client configurations are valid before building.

## User Stories

### STORY-2.1: Define Base PrismConfig DTO
**As a** Developer,
**I want** a typed Data Transfer Object for `config.php`,
**so that** I get IDE autocompletion and strict schema enforcement.

**Acceptance Criteria:**
- [ ] `PrismConfig` class created using `Spatie\LaravelData\Data`.
- [ ] Properties defined for `theme_preset`, `compliance_mode`, `brand_colors`, etc.
- [ ] Validation rules (required, type-check) added to DTO properties.

---

### STORY-2.2: Implement Build-Time Config Validator
**As a** Developer,
**I want** the build to fail if `config.php` is invalid,
**so that** I don't deploy broken or non-compliant sites.

**Acceptance Criteria:**
- [ ] `BuildValidator` listener runs before Jigsaw starts rendering.
- [ ] Validator maps `config.php` array to `PrismConfig` DTO.
- [ ] If validation fails, the build halts with a clear error message in the CLI.

---

### STORY-2.3: Polymorphic Niche Configuration
**As an** Implementation Specialist,
**I want** the config schema to change based on the selected niche,
**so that** I am prompted for `supplement_facts` only when in `supplements` mode.

**Acceptance Criteria:**
- [ ] DTO handles conditional requirements (e.g., if `compliance_mode == 'supplements'`, then `fda_disclaimer` is required).
- [ ] Unit tests verify that invalid niche combinations throw validation errors.

---

## Technical Notes
- Reference `spatie/laravel-data` documentation for advanced validation rules.
- Ensure the DTO is registered as a singleton in the Service Container during the build.
