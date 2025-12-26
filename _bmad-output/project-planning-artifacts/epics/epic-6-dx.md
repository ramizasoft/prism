# EPIC-6: Developer Experience & Starter Repo

**Status:** Not Started
**Priority:** P1
**Objective:** Finalize the "Thin Client" starter template and internal documentation to empower other developers.

## User Stories

### STORY-6.1: Prism Starter Template Repository
**As a** Junior Developer,
**I want** a clean starter repository,
**so that** I can start a new client project in seconds.

**Acceptance Criteria:**
- [ ] `prism-starter` repository created with minimal files.
- [ ] Includes a sample `config.php` with helpful comments.
- [ ] Pre-configured `source/_products/example.md` to demonstrate front-matter validation.

---

### STORY-6.2: VS Code IntelliSense Support
**As a** Developer,
**I want** autocompletion for `config.php` in VS Code,
**so that** I don't have to refer to the docs for every key name.

**Acceptance Criteria:**
- [ ] A JSON schema generated from the `PrismConfig` DTO.
- [ ] `.vscode/settings.json` included in the starter repo to map `config.php` to the schema.

---

### STORY-6.3: Internal Documentation Site (Built with Prism)
**As a** New Hire,
**I want** a "Getting Started" guide,
**so that** I can learn the Prism workflow independently.

**Acceptance Criteria:**
- [ ] Documentation site created using the `prism` engine itself.
- [ ] Covers installation, configuration, and how to create new products.
- [ ] Includes a "Compliance Guide" explaining the different niche modes.

---

## Technical Notes
- The documentation site serves as the ultimate "Dogfooding" test for the engine.
- Ensure the JSON schema is automatically updated whenever the `PrismConfig` DTO changes.
