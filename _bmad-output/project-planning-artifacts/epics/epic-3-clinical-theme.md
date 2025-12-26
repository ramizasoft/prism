# EPIC-3: Clinical Theme & Component Library

**Status:** Not Started
**Priority:** P1
**Objective:** Create the first visual theme and the base library of namespaced Blade components.

## User Stories

### STORY-3.1: CSS Variable Injection Engine
**As a** Designer,
**I want** theme colors to be controlled via CSS variables in `config.php`,
**so that** I can rebrand a site without touching CSS files.

**Acceptance Criteria:**
- [ ] Root Blade layout injects inline styles mapping `config.php` values to `--prism-` CSS variables.
- [ ] Tailwind config uses these variables for its theme (e.g., `colors: { primary: 'var(--prism-color-primary)' }`).

---

### STORY-3.2: Base Layout & UI Components
**As an** Implementation Specialist,
**I want** a set of standard UI components (Header, Footer, Hero, Product Card),
**so that** I can build pages quickly.

**Acceptance Criteria:**
- [ ] Components created in `resources/views/components/ui/` within the engine.
- [ ] Components are namespaced (e.g., `<x-prism::ui.hero />`).
- [ ] Components are fully responsive and use Tailwind.

---

### STORY-3.3: "Clinical" Preset Styles
**As a** Customer,
**I want** a professional "Clinical" look for my supplement brand,
**so that** my site looks trustworthy and clean.

**Acceptance Criteria:**
- [ ] `clinical.css` preset created in `resources/assets/css/presets/`.
- [ ] Preset defines default typography (sans-serif) and spacing appropriate for healthcare.
- [ ] Preset is automatically applied when `theme_preset => 'clinical'` is set in config.

---

## Technical Notes
- Use Tailwind CSS JIT mode to ensure only used styles are compiled.
- Reference ADR-005 for component naming conventions.
