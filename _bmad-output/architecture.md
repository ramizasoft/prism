---
stepsCompleted: [1, 2, 3, 4, 5, 6, 7]
inputDocuments: ['_bmad-output/prd.md', 'project-context.md', 'idea.md']
hasProjectContext: true
project_context_rules: 4
workflowType: 'architecture'
project_name: 'prism'
user_name: 'Sakib'
date: '2025-12-25'
---

# Architecture Decision Document

_This document builds collaboratively through step-by-step discovery. Sections are appended as we work through each architectural decision together._

## Project Context Analysis

### Requirements Overview

**Functional Requirements:**
The system requires a "Factory Architecture" consisting of a centralized `prism` core engine (Composer package) and lightweight client instances. Key functionality includes:
- **Configuration-Driven Design:** `config.php` controls niche presets, branding, and feature toggles.
- **Dynamic Presets:** Support for multiple visual themes (Clinical, Playful, etc.) via Tailwind JIT and CSS variables.
- **Compliance Mode:** Automatic injection of regulatory content (FDA disclaimers, Supplement Facts) based on `compliance.mode`.
- **Build-Time Validation:** Strict schema checks to prevent incomplete data deployment.
- **CLI Tooling:** Bulk update capabilities for fleet management.

**Non-Functional Requirements:**
- **Performance:** Absolute requirement for 100/100 Google Lighthouse scores.
- **Scalability:** Architecture must support 1 developer managing 50+ sites.
- **Compliance:** 100% acceptance rate for Amazon Brand Registry (FDA/AAFCO).
- **Maintainability:** "One-to-Many" update model via Composer.
- **Security:** Static HTML output to minimize attack surface.

**Scale & Complexity:**
- **Primary Domain:** Developer Tool / Static Site Generator.
- **Complexity Level:** Medium. Complexity resides in the engine's abstraction and compliance logic, not in the resulting static sites.
- **Estimated Architectural Components:** Core Engine, Client Instance Template, CLI Tools, Component Library (Blade/Tailwind).

### Technical Constraints & Dependencies

- **Stack:** PHP 8.2+, Jigsaw (SSG), Tailwind CSS (JIT), Blade Templates.
- **Distribution:** Composer for the core engine.
- **Hosting:** cPanel (via Git) or standard static hosting.
- **Constraint:** Client repos must remain "thin" - no custom logic that breaks the update path.

### Cross-Cutting Concerns Identified

- **Configuration Management:** The `config.php` schema is the single source of truth and must be robust.
- **Compliance Injection:** Legal text and structured data must be injected consistently across multiple components and layouts.
- **Theming System:** The preset system must handle drastic visual changes without code duplication.
- **Validation Pipeline:** Error handling must occur at build time to protect production.

## Starter Template Evaluation

### Primary Technology Domain

**Developer Tool / Static Site Generator (PHP Ecosystem)**

### Starter Options Considered

1.  **Standard Jigsaw Scaffolding (`jigsaw init`)**
    *   **Pros:** Clean slate, official support, Vite integration (v1.8+).
    *   **Cons:** Minimalist; lacks the "Engine" abstraction out-of-the-box.
2.  **Laravel Zero (for CLI)**
    *   **Pros:** Robust framework for building the `prism` CLI tool needed for fleet management.
    *   **Cons:** Additional complexity to maintain alongside the site generator.
3.  **Modern JS SSGs (Astro/Next.js)**
    *   **Analysis:** Rejected. While powerful, they break the unified PHP/Composer ecosystem required for the "Factory Pattern" where a single PHP developer manages 50+ sites using familiar tools (Blade/Composer).

### Selected Starter: Hybrid Approach (Jigsaw + Laravel Zero)

**Rationale for Selection:**
We are choosing a hybrid path to support the "Factory Pattern":
1.  **Jigsaw (v1.8+):** The core static site generator. It provides the "boring," stable, and high-performance foundation (100/100 Lighthouse) using Blade templates.
2.  **Laravel Zero (v12.x):** The "Operating System" for the factory. It will power the `prism` CLI to handle bulk updates, schema validation, and deployment orchestration across 50+ repos.

**Key Architectural Mitigations (From Party Mode):**
*   **The Vendor Gap:** Jigsaw defaults to looking for files in `source/`. We must implement a custom build process (via the Laravel Zero CLI or Jigsaw events) to allow the engine to load templates and assets directly from the `vendor/nsakib176/prism` package, keeping client repos "thin."
*   **Fleet Orchestration:** The CLI is not optional; it is critical infrastructure to prevent "versioning hell" when managing dozens of sites.

**Initialization Command:**

```bash
# 1. Initialize the Core Engine (CLI + Logic)
composer global require laravel-zero/installer
laravel-zero new prism-engine

# 2. Add Jigsaw to the Engine
cd prism-engine
composer require tightenco/jigsaw

# 3. Create the "Thin Client" Starter Template (Manual Setup)
mkdir prism-starter
cd prism-starter
composer init --name="prism/starter" --require="nsakib176/prism-engine:dev-main"
```

**Architectural Decisions Provided by Starter:**

**Language & Runtime:**
- PHP 8.2+ (Strict Types)

**Styling Solution:**
- Tailwind CSS (JIT Mode) configured via `tailwind.config.js` in the engine.

**Build Tooling:**
- Vite (Asset Compilation)
- Laravel Zero (Build Orchestration & Validation)

**Testing Framework:**
- Pest PHP (via Laravel Zero) for testing the engine logic and compliance rules.

**Code Organization:**
- **Engine:** `src/` (Commands, Validation Logic), `resources/views/` (Shared Blade Components).
- **Client:** `config.php` (The Brain), `source/_content` (Markdown).

**Development Experience:**
- "Factory" workflow: Update the engine -> Run `prism update:all` -> Deploy 50 sites.

## Core Architectural Decisions

### Decision Priority Analysis

**Critical Decisions (Block Implementation):**
- **Configuration Validation Strategy:** Using DTOs (Data Transfer Objects) to ensure `config.php` is valid before the build starts.
- **Compliance Injection Method:** Using Smart Blade Components (explicit placement) instead of global injection (middleware).

**Important Decisions (Shape Architecture):**
- **Fleet Deployment:** Local CLI Iterator (`prism update:all`) for bulk management of client repositories.
- **Lead Magnet Handling:** Native PHP form handlers to maintain cPanel compatibility without third-party dependencies.

**Deferred Decisions (Post-MVP):**
- **SaaS Dashboard:** A GUI for configuration is deferred until the CLI-based factory is stable.
- **Direct-to-Amazon API Sync:** Real-time stock/price syncing is deferred to Phase 2.

### Data Architecture

**Configuration Schema & Validation**
- **Decision:** Implement **Typed DTOs** for configuration using `spatie/laravel-data` (v4.18.0).
- **Rationale:** Provides the best Developer Experience (DX). Users get IDE autocompletion within their `config.php`, and the engine catches errors *before* the Jigsaw build begins.
- **Affects:** Core Engine, Configuration Validator.

**Niche-Specific Data Modeling**
- **Decision:** Use **Polymorphic Configuration Nodes**.
- **Rationale:** Allows the `config.php` to adapt its schema based on the `compliance.mode`. For example, if mode is `supplements`, a `supplement_facts` key becomes required.
- **Affects:** Blade Components, Build Validation.

### Authentication & Security

**Site Security**
- **Decision:** **Pure Static Output.**
- **Rationale:** The primary security layer. By compiling to HTML, we eliminate the vast majority of web vulnerabilities (SQLi, XSS, etc.) common in WordPress.
- **Provided by Starter:** Jigsaw.

**Form Security (Lead Magnets)**
- **Decision:** **CSRF Protection via Session/Token** in the native PHP handler.
- **Rationale:** Ensures that even simple PHP scripts on cPanel are protected against cross-site request forgery.

### API & Communication Patterns

**Internal Engine Communication**
- **Decision:** **Laravel Service Container & Events.**
- **Rationale:** Since Jigsaw and Laravel Zero both utilize Laravel's core components, we will use the Service Container to manage the "Design Engine" state and Jigsaw Events to hook into the build lifecycle.

### Frontend Architecture

**Theming Engine**
- **Decision:** **Tailwind JIT with CSS Variable Injection.**
- **Rationale:** Allows a single CSS file in the core engine to be re-branded instantly by injecting values from `config.php` into the root CSS variables.

**Compliance Injection**
- **Decision:** **Smart Blade Components.**
- **Rationale:** Components like `<x-prism::compliance-footer />` will encapsulate the logic to render FDA or AAFCO disclaimers based on the active niche, providing clarity and flexibility.

### Infrastructure & Deployment

**Fleet Management**
- **Decision:** **Local CLI Iterator (`prism update:all`).**
- **Rationale:** Empowers the solo developer to maintain control. The script will iterate through client directories, run `git pull`, `composer update`, and `git push`.
- **Affects:** Maintenance Workflow.

### Decision Impact Analysis

**Implementation Sequence:**
1.  **Engine Core:** Setup Laravel Zero with `spatie/laravel-data`.
2.  **Config Schema:** Define the base `PrismConfig` DTO.
3.  **Component Library:** Build the first "Smart Components" for the Clinical preset.
4.  **CLI Tooling:** Build the `prism update:all` command.

**Cross-Component Dependencies:**
- The **Validation Pipeline** in the CLI depends on the **DTO Schema**.
- **Smart Components** depend on the **Configuration DTO** to determine their render state.

## Implementation Patterns & Consistency Rules

### Pattern Categories Defined

**Critical Conflict Points Identified:**
4 areas where AI agents could make different choices: Naming, Component Logic, Asset Handling, and Build Validation.

### Naming Patterns

**Blade Components:**
- **Standard:** Use the `prism::` namespace for all core engine components.
- **Example:** `<x-prism::header />`, `<x-prism::fda-shield />`.

**Config Keys:**
- **Standard:** Always use `snake_case`.
- **Example:** `compliance_mode`, `brand_primary_color`.

**CSS Variables:**
- **Standard:** Prefix with `--prism-` to avoid collisions.
- **Example:** `--prism-color-primary`, `--prism-font-heading`.

### Structure Patterns

**Project Organization:**
- **Engine Logic:** `src/` (DTOs, Commands, Jigsaw Listeners).
- **Engine UI:** `resources/views/` (Blade components).
- **Engine Assets:** `resources/assets/` (Tailwind base, CSS presets).
- **Client Repo:** `config.php` (Brain), `source/` (Products, Images).

**File Structure Patterns:**
- **Presets:** CSS presets live in `resources/assets/presets/` within the engine.
- **Tests:** Pest tests live in `tests/` in the engine repo.

### Format Patterns

**CLI Outputs:**
- **Standard:** Color-coded status prefixes.
- **Example:** `[Error] Config: Missing 'amazon_url'`, `[Success] Build: Completed in 1.2s`.

**Data Exchange Formats:**
- **Standard:** Config DTOs must be the single source of truth for component logic.

### Process Patterns

**Error Handling Patterns:**
- **Standard:** **Fail Fast.** Any validation error during build must kill the process and return a non-zero exit code.

**Enforcement Guidelines:**

**All AI Agents MUST:**
- Never place client-specific logic in the `prism` package.
- Reference the `PrismConfig` DTO for all conditional rendering logic.
- Use namespaced components to ensure upgrade safety.

### Pattern Examples

**Good Examples:**
```php
// In config.php
'compliance' => [
    'mode' => 'supplements',
],

// In a Blade component
@if($config->compliance->isSupplements())
    <x-prism::fda-shield />
@endif
```

**Anti-Patterns:**
```php
// Avoid hardcoding legal text in a client repo
<p>This statement has not been evaluated by the FDA...</p>

// Avoid non-namespaced components
<x-header /> (Could conflict with a local client header)
```

## Project Structure & Boundaries

### Complete Project Directory Structure

**Engine Repository (`prism/prism-engine`)**
```plaintext
prism-engine/
├── app/
│   ├── Commands/
│   │   ├── BuildAllCommand.php    <-- prism update:all
│   │   ├── ValidateConfigCommand.php
│   │   └── InitClientCommand.php
├── config/
│   └── prism.php
├── resources/
│   ├── assets/
│   │   ├── css/
│   │   │   ├── app.css
│   │   │   └── presets/
│   │   │       ├── clinical.css
│   │   │       └── playful.css
│   └── views/
│       ├── components/            <-- Namespaced prism::
│       │   ├── layout/
│       │   ├── compliance/
│       │   └── ui/
├── src/
│   ├── Data/
│   │   ├── ConfigData.php         <-- Typed Spatie Data Object
│   │   └── ProductData.php
│   ├── Listeners/
│   │   └── BuildValidator.php
├── tests/
│   ├── Feature/
│   └── Unit/
├── composer.json
├── tailwind.config.js
└── vite.config.js
```

**Client Repository (`prism-client-starter`)**
```plaintext
prism-client-a/
├── source/
│   ├── _assets/
│   ├── _products/
│   ├── images/
│   └── index.blade.php
├── config.php                     <-- THE BRAIN
├── composer.json
├── tailwind.config.js
└── package.json
```

### Architectural Boundaries

**API Boundaries:**
The "API" is internal and schema-based. The primary boundary is the `PrismConfig` DTO, which acts as the contract between the Client and the Engine.

**Component Boundaries:**
All core UI logic resides in the `prism-engine` package. The Client instance is restricted to content (Markdown) and configuration (PHP).

**Data Boundaries:**
The Engine consumes structured data (YAML/Markdown) from the Client repository and renders it through validated Blade components.

### Requirements to Structure Mapping

**Feature: Compliance Mode**
- Logic: `src/Data/ConfigData.php` (Polymorphic checks).
- UI: `resources/views/components/compliance/`.
- Mapping: FR-004 (FDA Disclaimer), FR-005 (AAFCO Statement).

**Feature: Brand Factory (One-to-Many)**
- Logic: `app/Commands/BuildAllCommand.php`.
- Logic: `src/Listeners/BuildValidator.php`.
- Mapping: Success Criteria (Scalability Ratio 1:50).

### Integration Points

**Internal Communication:**
The `prism-engine` uses Jigsaw's event hooks (`beforeBuild`) to run the `BuildValidator` and inject the `ConfigData` singleton into the Blade environment.

**Data Flow:**
1. `prism build` triggers.
2. `BuildValidator` loads `config.php`.
3. `ConfigData` DTO validates the array.
4. Validated DTO is shared globally with all Blade components.
5. Blade components render using namespaced engine templates.
6. Vite compiles assets using the CSS presets.

## Architecture Validation Results

### Coherence Validation ✅

**Decision Compatibility:**
The selection of Jigsaw (SSG) and Laravel Zero (CLI) is highly coherent as they share core Laravel components (Service Container, Filesystem, Blade). PHP 8.2+ ensures modern language features for the "Factory Pattern" implementation.

**Pattern Consistency:**
Implementation patterns (Namespacing with `prism::`, Snake_case config, Typed DTOs) directly support the goal of a robust, upgradeable design engine.

**Structure Alignment:**
The dual-repository structure (Engine vs Client) perfectly mirrors the "Factory" requirement, ensuring clean boundaries and zero custom logic in client repos.

### Requirements Coverage Validation ✅

**Functional Requirements Coverage:**
- **Configuration-Driven Design:** Fully covered by typed DTO validation.
- **Compliance Mode:** Supported by polymorphic DTOs and smart Blade components.
- **CLI Tooling:** Centrally managed via Laravel Zero commands.

**Non-Functional Requirements Coverage:**
- **Performance:** Guaranteed 100/100 Lighthouse via static Jigsaw output.
- **Scalability:** Addressed via the `prism update:all` orchestration command.
- **Compliance:** 100% Brand Registry compliance enforced via build-time validation.

### Implementation Readiness Validation ✅

**Decision Completeness:**
All critical decisions (Validation strategy, Component injection, Deployment model) are documented with rationale and versions.

**Structure Completeness:**
A detailed directory tree is provided for both the engine package and the client starter template.

**Pattern Completeness:**
Naming, structure, and process patterns are defined with concrete "Good" and "Anti-pattern" examples.

### Gap Analysis Results

**Critical Gaps:** None identified.
**Important Gaps:** Defined the specific file paths for CSS presets in `resources/assets/css/presets/` to clarify theme switching logic.
**Minor Gaps:** CLI command flags (e.g., `--dry-run` for `update:all`) will be defined during story creation.

### Architecture Completeness Checklist

**✅ Requirements Analysis**
- [x] Project context thoroughly analyzed
- [x] Scale and complexity assessed
- [x] Technical constraints identified
- [x] Cross-cutting concerns mapped

**✅ Architectural Decisions**
- [x] Critical decisions documented with versions
- [x] Technology stack fully specified
- [x] Integration patterns defined
- [x] Performance considerations addressed

**✅ Implementation Patterns**
- [x] Naming conventions established
- [x] Structure patterns defined
- [x] Communication patterns specified
- [x] Process patterns documented

**✅ Project Structure**
- [x] Complete directory structure defined
- [x] Component boundaries established
- [x] Integration points mapped
- [x] Requirements to structure mapping complete

### Architecture Readiness Assessment

**Overall Status:** READY FOR IMPLEMENTATION

**Confidence Level:** HIGH

**Key Strengths:**
- **Rock-solid Abstraction:** Separation of engine and instance prevents technical debt at scale.
- **Compliance-as-Code:** Legal requirements are hardcoded in the engine but toggled via the client config.
- **Superior DX:** Typed configuration ensures implementation specialists (Junior Devs) are guided by their IDE.

### Implementation Handoff

**AI Agent Guidelines:**
- Follow all architectural decisions exactly as documented.
- Use the `prism::` namespace for all core components.
- Enforce validation at build time without exceptions.

**First Implementation Priority:**
Initialize the Laravel Zero core engine and define the base `PrismConfig` DTO.
