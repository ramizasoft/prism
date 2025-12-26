# EPIC-4: Compliance Engine

**Status:** Not Started
**Priority:** P0
**Objective:** Automate regulatory compliance requirements (FDA/AAFCO) through the "Compliance-as-Code" pattern.

## User Stories

### STORY-4.1: Automated FDA Disclaimer Injection
**As a** Lead Developer,
**I want** the FDA disclaimer to be automatically added to the footer when `supplements` mode is active,
**so that** I never forget this legal requirement.

**Acceptance Criteria:**
- [ ] `<x-prism::compliance-footer />` component created.
- [ ] Component checks `ConfigData->compliance->mode`.
- [ ] If `supplements`, it renders the standard FDA "Shield" and mandatory text.

---

### STORY-4.2: Structured Supplement Facts Component
**As a** Content Manager,
**I want** to provide supplement facts in a structured format (YAML),
**so that** they are rendered perfectly every time.

**Acceptance Criteria:**
- [ ] `<x-prism::supplement-facts />` component created.
- [ ] Accepts a data array or object from the product Markdown front-matter.
- [ ] Renders a legally compliant table with correct bolding, indentation, and daily value symbols.

---

### STORY-4.3: Compliance Badge Library (SVGs)
**As a** Designer,
**I want** high-quality, verified SVGs for GMP/FDA badges,
**so that** the site looks professional and compliant.

**Acceptance Criteria:**
- [ ] Library of verified SVGs included in `resources/assets/images/compliance/`.
- [ ] Components like `<x-prism::badge-gmp />` available for easy insertion.

---

## Technical Notes
- Compliance text should be centrally defined in the engine but overridable in `config.php` if needed.
- Validation should ensure `supplement_facts` are present if a product is tagged as a supplement.
