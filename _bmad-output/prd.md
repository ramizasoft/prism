---
stepsCompleted: [1, 2, 3, 4, 5, 6, 7, 8]
inputDocuments: ['_bmad-output/project-planning-artifacts/product-brief-prism-2025-12-25.md']
documentCounts:
  briefs: 1
  research: 0
  brainstorming: 0
  projectDocs: 0
workflowType: 'prd'
lastStep: 8
project_name: 'prism'
user_name: 'Sakib'
date: '2025-12-25'
---

# Product Requirements Document - prism

**Author:** Sakib
**Date:** 2025-12-25

## Executive Summary

**Prism** is a high-performance, static site generator platform engineered as a "Brand Factory" for Amazon sellers and niche businesses. It solves the critical trade-off between speed, cost, and quality by separating a centralized **Design Engine** from lightweight **Client Instances**. This architecture empowers a single development team to rapidly deploy and maintain dozens of compliant, lightning-fast brand websites with minimal overhead.

Prism targets the specific pain points of Amazon sellers: the need for Brand Registry compliance (FDA/AAFCO), ad-optimized page speed (100/100 Google Lighthouse), and audience ownership via lead magnets, all delivered at a competitive price point through operational efficiency.

### What Makes This Special

Prism distinguishes itself through its **Factory Architecture** and **Compliance-as-Code** philosophy. Unlike generic builders (Wix/Squarespace) that require manual configuration for every site, Prism leverages a "One-to-Many" update model where core improvements propagate to all clients instantly. Furthermore, it embeds "Niche Intelligence" directly into the codebase—automatically injecting regulatory disclaimers and structured data (e.g., Supplement Facts) based on a simple configuration, solving a major legal hurdle that generic themes ignore.

## Project Classification

**Technical Type:** developer_tool (Static Site Generator / Theme Engine)
**Domain:** e-commerce (niche: supplements/pet-food)
**Complexity:** medium (high compliance rigor)
**Project Context:** Greenfield - new project

## Success Criteria

### User Success (Internal Development Team)
*   **End-to-End Deployment Time:** < 60 minutes to go from "Repo Creation" to "Live Production URL" (including basic content population for ~5 products).
*   **Zero-Touch Maintenance:** Routine updates (security patches, core bug fixes) require < 1 hour/week total for a portfolio of 50 sites.
*   **Onboarding Velocity:** A new Junior Developer can independently deploy a compliant, production-ready site within 4 hours of first reading the documentation.

### Business Success (Agency)
*   **Scalability Ratio:** 1 Full-Time Developer successfully manages 50+ active client instances (vs. industry standard of ~10-15).
*   **Cost Efficiency:** Reduction of "Cost of Goods Sold" (COGS) per website build by 70% compared to previous agency workflows.
*   **Reference Validation:** Successful launch of the first "Reference Implementation" within 3 months to validate the architecture.

### Technical Success
*   **Performance Standard:** 100/100 Google Lighthouse score (Performance, Accessibility, Best Practices, SEO) out-of-the-box for every preset.
*   **Build Reliability:** Jigsaw build times < 30 seconds; 100% deterministic builds (no "it works on my machine" issues).
*   **Compliance Assurance:** 100% acceptance rate for Amazon Brand Registry applications for sites using the "Compliance Mode" features.

### Measurable Outcomes
*   **3 Month Target:** Core Engine v1.0 released + 1 Live Reference Client (Vitamin Niche).
*   **12 Month Target:** 50 Active Clients + $250k ARR from maintenance/hosting.

## Product Scope

### MVP - Minimum Viable Product
*   **Core Engine (`prism`):** Composer package with Jigsaw scaffolding and Tailwind JIT.
*   **Dynamic Component Library:** Base Blade components (Header, Footer, Hero, ProductGrid) with config-driven styling.
*   **Preset 1 ("Clinical"):** Visual theme optimized for Vitamin/Supplement brands.
*   **Compliance Mode ("Supplements"):** FDA Disclaimer injection and Supplement Facts table component.
*   **Reference Client Repo:** A "Thin Repository" acting as the master template and proof-of-concept.

### Growth Features (Post-MVP)
*   **Additional Presets:** Playful (Pet), Luxury (Artisanal), Organic (Food).
*   **Expanded Compliance:** AAFCO (Pet Food), Cosmetics labeling logic.
*   **Automated CI/CD:** GitHub Actions workflows for "Push-to-Deploy" across the fleet.
*   **Lead Magnet Module:** Integration with ESPs (Mailchimp/ConvertKit) for email capture.

### Vision (Future)
*   **Prism SaaS Dashboard:** A GUI for non-technical users to configure `config.php` and manage content.
*   **Direct-to-Amazon Integration:** Real-time API sync for pricing and inventory status.
*   **Ecosystem Expansion:** "Preset Store" for third-party developers to sell niche themes.

## User Journeys

### Journey 1: Sakib - The Architect's "One-to-Many" Triumph
Sakib, the Lead Developer, wakes up to an email: "The FDA updated their mandatory disclaimer text for all supplement websites." In his old agency life, this would mean logging into 50 separate WordPress admin panels, copy-pasting text, and praying he didn't miss one. It would take all week.

With Prism, Sakib opens his IDE and navigates to the `prism` core package. He finds the `compliance.php` config file and updates the `fda_disclaimer` string. He commits the change and tags it as `v1.1.0`. He then runs his custom deployment script: `prism update:all`. The script iterates through all 50 client repositories, runs `composer update`, rebuilds the static HTML, and deploys.

Twenty minutes later, he replies to the email: "Done. All 50 sites are compliant." He spends the rest of the day working on the new "Pet Food" preset instead of doing data entry.

### Journey 2: Devon - The Junior Dev's First Deploy
Devon is a new hire. It's his first day, and he's nervous. His task: "Launch the 'PureVits' website by 5 PM." He opens the internal Prism documentation. It says: "Step 1: Create a new repo from `prism-starter-template`." He does it. "Step 2: Run `composer require nsakib176/prism`." Done.

He opens `config.php`. The comments guide him: `// Set niche: 'supplements' or 'pet_food'`. He types `'supplements'`. He sets the primary color to PureVits' brand blue. He runs `npm run build`.

He opens the local preview. It looks professional. The "Supplement Facts" table is there. The FDA shield is in the footer. He didn't have to code any of it. He drops the client's logo into the images folder and pushes to production at 2 PM. He feels like a 10x developer.

### Journey 3: Sarah - The Content Specialist's "Broken Build" Save
Sarah is adding a new product: "Mega-C 1000mg." She creates a new file `vitamin-c.md`. She copies the Front Matter from another file but accidentally deletes the `price` field.

She runs the build command. Instead of generating a broken page that shows "$0.00" or a blank space, the Prism build engine halts and outputs a clear error in red: `[Error] Product 'Mega-C' is missing required field 'price'. Build cancelled.`

She realizes her mistake immediately, adds the price, and rebuilds. Prism's strict validation saved her from deploying a pricing error that could have cost the client money.

### Journey Requirements Summary
*   **Core:** Centralized configuration for compliance text (Journey 1).
*   **CLI:** Bulk update scripts/tooling compatibility (Journey 1).
*   **DX:** Self-documenting `config.php` and starter templates (Journey 2).
*   **Compliance:** Automatic component injection based on config (Journey 2).
*   **Validation:** Strict schema enforcement during the build process to prevent bad data deployment (Journey 3).

## Domain-Specific Requirements

### Healthcare & Supplements Compliance Overview
The MVP of Prism focuses on the Vitamin and Supplement industry, a highly regulated space governed by the FDA. The primary regulatory risk is "Unauthorized Health Claims"—sites must visually and structurally separate marketing claims from mandatory legal disclaimers.

### Key Domain Concerns
*   **Disclaimer Enforcement:** Mandatory FDA "Shield" and disclaimer text must be present on every page where a product is mentioned.
*   **Nutritional Transparency:** The "Supplement Facts" panel is a legal document. It must be rendered with precise formatting to meet industry standards for legibility and order of ingredients.
*   **Audience Data Privacy:** Collection of health-interest data via lead magnets (e.g., "Sign up for Joint Health tips") triggers heightened privacy requirements (GDPR/CCPA).

### Compliance Requirements
*   **Automatic Disclaimer Injection:** The engine must inject the global FDA disclaimer into the footer of all pages when `compliance.mode = 'supplements'`.
*   **Contextual Warnings:** Product pages must include the disclaimer directly adjacent to any "structure/function" claims.
*   **Schema Validation:** The build process must validate that every Supplement Facts panel contains the mandatory "Percent Daily Value" column or its appropriate "†" exception.

### Industry Standards & Best Practices
*   **Accessibility (WCAG 2.1):** Regulatory compliance requires high contrast and legibility, particularly for ingredient lists and legal text.
*   **Mobile-First Legal:** Disclaimers must remain visible and legible on mobile viewports, not just hidden in sub-menus.

### Implementation Considerations
*   **Standardized SVG Library:** Prism will ship with high-quality, verified SVGs for "Made in USA," "GMP Certified," and "FDA Registered Facility" badges to prevent clients from using non-compliant or low-quality imagery.
*   **Structured Facts Input:** The engine will favor a structured YAML/JSON input for Supplement Facts rather than raw HTML to ensure formatting consistency across the fleet.

## Innovation & Novel Patterns

### Detected Innovation Areas
*   **The Factory Paradigm:** Prism explicitly rejects the standard "one-off agency build" model. It treats website creation as a manufacturing process (a central engine with configurable instances). This is a paradigm shift for managing portfolios of client sites, focusing on economies of scale rather than billable hours.
*   **Compliance-as-Code (DSL):** The `compliance.mode` setting in `config.php` acts as a Domain-Specific Language for regulatory requirements. Instead of developers manually adding legal text or components, the business rule is declared once (`'supplements'`) and the engine handles the implementation.
*   **Build-Time Validation:** By validating the content schema (e.g., missing `price` field) during the static build process, Prism moves error checking from a "runtime" problem (on the live site) to a "compile-time" problem (in the developer's terminal), preventing bad data from ever reaching production.

### Market Context & Competitive Landscape
*   **WordPress/Plugins:** The dominant model relies on runtime PHP and a jungle of plugins. Prism's innovation is its static-first, dependency-controlled approach, which eliminates this entire class of maintenance and security problems.
*   **Headless CMS + SSG (Jamstack):** While technically similar (static site generation), this ecosystem often requires developers to stitch together multiple services (Contentful, Netlify, etc.). Prism's innovation is its vertical integration—it's a self-contained "factory" designed for a specific business purpose, not a general-purpose tech stack.

### Validation Approach
*   **Factory Paradigm:** Success is validated by the "Scalability Ratio" (1 Dev : 50 Sites). If this ratio is achieved, the paradigm is proven.
*   **Compliance-as-Code:** Success is validated by the "Compliance Assurance" metric (100% Brand Registry approval rate).
*   **Build-Time Validation:** Success is validated by monitoring support tickets related to content errors on live sites. The target is zero.

### Risk Mitigation
*   **Paradigm Adoption:** The "Factory" model requires a shift in developer mindset. Mitigation: Clear documentation and the `prism-starter-template` will be critical to reduce the learning curve.
*   **DSL Flexibility:** The "Compliance-as-Code" could become too rigid. Mitigation: The system will allow for `disclaimer_override` fields in `config.php` to handle client-specific legal language while still using the core engine's structure.

## developer_tool Specific Requirements

### Project-Type Overview
Prism is a specialized developer tool designed to bridge the gap between a centralized theme engine and distributed client instances. It functions as a "meta-framework" on top of Jigsaw, providing opinionated structure and compliance logic for agency-scale website deployment.

### Technical Architecture Considerations
*   **Language & Tooling Matrix:**
    *   **Runtime:** PHP 8.2+
    *   **Engine:** Jigsaw SSG (Static Site Generator)
    *   **Templating:** Laravel Blade
    *   **Styling:** Tailwind CSS (JIT mode)
    *   **Dependency Management:** Composer (PHP), NPM (Assets)

*   **Installation & Distribution:**
    *   The core engine will be distributed via a private or public Composer package (`nsakib176/prism`).
    *   Client instances will utilize a "Starter Template" repository to ensure standardized directory structures.

*   **The "API Surface" (config.php Schema):**
    *   `prism` will expose a comprehensive configuration schema. Key nodes include `theme_preset`, `compliance.mode`, `brand.colors`, and `lead_capture.settings`.
    *   **Validation:** The engine will implement a `ConfigValidator` class to catch missing required fields (like `amazon_url` or `disclaimer_text`) during the build process, preventing deployment of incomplete sites.

### Implementation Specifics
*   **Code Examples & DX:**
    *   The engine will include a `/docs/examples` folder containing sample `config.php` files for each vertical (Clinical, Playful, etc.).
    *   To assist implementation specialists, a VS Code `settings.json` or `.json-schema` will be provided to enable IntelliSense for the configuration file.

*   **Migration & Versioning Strategy:**
    *   **SemVer Enforcement:** Strict adherence to Semantic Versioning to prevent breaking client builds.
    *   **Automated Migration:** For major version changes (e.g., v1.x to v2.x), the core package will include a `migrate` CLI command to update client configuration structures automatically.

## Project Scoping & Phased Development

### MVP Strategy & Philosophy

**MVP Approach:** **Platform MVP.** The primary goal is to prove the "Design Engine + Client Instance" architecture works. We will build a rock-solid core that supports exactly one vertical (Clinical/Supplements) to validate the "Factory Pattern" and "Compliance-as-Code" innovations.

**Resource Requirements:** 1 Lead Architect (Core Engine) and 1 Implementation Specialist (First Client Instance).

### MVP Feature Set (Phase 1)

**Core User Journeys Supported:**
*   **The "One-to-Many" Triumph:** Centralized core updates propagating to instances.
*   **The Junior Dev Wizard:** Rapid instance spin-up from a starter template.
*   **The Broken Build Save:** Basic build-time validation for required product fields.

**Must-Have Capabilities:**
*   Versioned `prism` Composer package.
*   "Clinical" preset (CSS Variables + Blade Components).
*   "Supplements" Compliance Mode (FDA Disclaimer injection).
*   Standardized `config.php` schema with basic validation.
*   Reference implementation repository (e.g., `vital-core-labs`).

### Post-MVP Features

**Phase 2 (Post-MVP):**
*   Additional Presets: Playful (Pet Products), Luxury (Homemade Goods).
*   New Compliance Modes: AAFCO (Pet Food), Cosmetics (INCI).
*   Lead Magnet Integration: API hooks for Mailchimp/ConvertKit.
*   Automated CI/CD: Fleet-wide deployment scripts.

**Phase 3 (Expansion):**
*   Prism SaaS Dashboard (GUI for client management).
*   Direct-to-Amazon API integration for real-time stock/price sync.
*   Third-party "Preset Store."

### Risk Mitigation Strategy

**Technical Risks:** The complexity of managing 50+ repos with a single dependency. **Mitigation:** Strict SemVer enforcement and building a `prism update:all` CLI script early in the process.
**Market Risks:** Clients demanding custom features that "break" the factory model. **Mitigation:** Strict "Separation of Concerns" policy—custom features go in the `client-repo`, never the `prism` core.
**Resource Risks:** One developer becoming a bottleneck. **Mitigation:** Focus heavily on "Self-Documenting Code" and VS Code IntelliSense support to empower Junior Developers.
