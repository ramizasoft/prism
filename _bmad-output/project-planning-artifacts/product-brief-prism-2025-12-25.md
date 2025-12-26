---
stepsCompleted: [1, 2, 3, 4, 5]
inputDocuments: []
workflowType: 'product-brief'
lastStep: 5
project_name: 'prism'
user_name: 'Sakib'
date: '2025-12-25'
---

# Product Brief: prism

<!-- Content will be appended sequentially through collaborative workflow steps -->

## Executive Summary
**Prism** is a high-performance, static site generator platform designed to function as a "Brand Factory" for Amazon sellers and niche businesses. It solves the dilemma of choosing between slow, generic DIY builders (Wix/Squarespace) and expensive custom agencies. By separating the **Design Engine** from **Client Instances**, Prism allows for the rapid deployment (minutes, not weeks) of compliant, lightning-fast, and visually distinct brand websites. It empowers the operator to offer superior quality and "set-and-forget" maintenance at a competitive price point, enabling clients to secure Amazon Brand Registry and own their customer audience without technical hassle.

---

## Core Vision

### Problem Statement
Amazon sellers and niche brand owners currently face a "High Cost or Low Quality" trade-off. DIY platforms like Wix or Squarespace produce slow, generic websites that lack industry-specific "trust signals" and hurt ad conversion rates. Custom agency builds are prohibitively expensive and require ongoing maintenance (updates, security patches) that distract owners from their core business.

### Problem Impact
*   **Lost Revenue:** Slow load times from bloated builders kill conversion rates on paid traffic.
*   **Brand Credibility:** Generic designs without proper regulatory elements (FDA/AAFCO) fail to secure Amazon Brand Registry or build customer trust.
*   **Maintenance Burden:** WordPress vulnerabilities and plugin conflicts create constant "hassle" and security risks.

### Why Existing Solutions Fall Short
*   **Generic Builders:** Prioritize ease-of-use over performance and compliance. They lack "Niche Intelligence" (e.g., knowing a vitamin site needs a Supplement Facts panel).
*   **Custom Agencies:** Do not scale. They build one-offs, driving up costs and timelines.

### Proposed Solution
**Prism** is a "Design Engine" built on Jigsaw (Static PHP) and Tailwind CSS. It operates on a **Factory Pattern**:
*   **Centralized Intelligence:** Shared logic, components, and "Compliance Modes" live in a single versioned package (`prism`).
*   **Rapid Instancing:** Client sites are lightweight repositories that configure the engine, not rebuild it.
*   **Compliance-First:** Automatically injects regulatory requirements (FDA, AAFCO) based on client configuration.

### Key Differentiators
*   **The Factory Model:** One codebase updates 50+ clients instantly. High leverage, low maintenance.
*   **Static Performance:** Guaranteed 100/100 PageSpeed scores for superior SEO and ad conversion.
*   **Niche Compliance:** Built-in regulatory features that generic themes cannot match.

## Target Users

### Primary Users (Internal Team)

**1. The Factory Architect (Lead Developer)**
*   **Role:** Maintains the core `prism` engine, designs shared Blade components, and develops new niche "Presets."
*   **Motivations:** Maximizing leverage through the "One-to-Many" pattern. Reducing maintenance debt.
*   **Needs:** A modular codebase, strict versioning (SemVer), and a reliable build pipeline that doesn't break client instances when core logic changes.

**2. The Implementation Specialist (Junior/Mid Developer)**
*   **Role:** Quickly spins up new client sites using the `prism` engine.
*   **Motivations:** High efficiency and speed-to-delivery.
*   **Needs:** Crystal-clear documentation, standardized "Thin Repo" templates, and "Step-by-Step" guides for configuring niche presets and compliance modes.

### Secondary Users (The Client)

**1. The Amazon Seller (Business Owner)**
*   **Role:** The owner of the final website.
*   **Needs:** A fast, professional site that secures Brand Registry and captures leads with zero technical effort on their part.
*   **Interaction:** They provide content (logo, products, colors) to the development team and receive a URL. They have minimal interaction with the `prism` code itself.

---

## User Journey: The "Factory Deployment" Workflow

1.  **Requirement Mapping:** The implementation specialist identifies the client's niche (e.g., Vitamins) and required "Vibe" (e.g., Clinical).
2.  **Instance Creation:** A new "Thin Repository" is created from a standard template.
3.  **Engine Integration:** The specialist runs `composer require nsakib176/prism`, pulling in the latest versioned design engine.
4.  **Configuration:** The `config.php` file is updated with the client's colors, logo paths, and `compliance.mode = 'supplements'`.
5.  **Content Loading:** Product data is dropped into the `/source/_products/*.md` folders.
6.  **Verification & Build:** The specialist runs the local build command (`npm run build`). Jigsaw compiles the static assets using the `prism` theme logic.
7.  **Maintenance Loop:** When a bug is fixed in the `prism` core, the specialist runs `composer update` across all active client instances to push the fix globally.

## Success Metrics

### User Success (Internal Team)
*   **Rapid Deployment:** Ability to spin up a fully configured, niche-compliant brand site in under 60 minutes.
*   **Low Maintenance Debt:** Single-command updates (`composer update`) to push core improvements across all client instances simultaneously.
*   **Documentation Clarity:** New developers should be able to deploy a production-ready site independently within 4 hours of reading the `prism` documentation.

### Client Value (The Amazon Seller)
*   **Performance Excellence:** Every site generated must achieve a 100/100 Google PageSpeed Insights score to maximize conversion on ad traffic.
*   **Compliance Certainty:** 100% first-time approval rate for Amazon Brand Registry through built-in "Compliance Modes."
*   **Lead Acquisition:** Successful integration of lead magnets to allow clients to "own" their audience data from Day 1.

---

## Business Objectives
*   **High-Margin Scalability:** Reduce the cost-of-delivery per site by at least 70% compared to traditional custom agency workflows.
*   **Portfolio Management:** Enable a single developer to successfully manage and maintain 50+ distinct brand websites without burnout or technical overhead.

---

## Key Performance Indicators
*   **Build Speed:** Jigsaw static compilation time under 30 seconds for a standard product site.
*   **Update Velocity:** Deploying a critical security patch or UI update to all 50+ clients in under 10 minutes.
*   **Standardization Ratio:** 90% of client sites running on core `prism` presets without custom code overrides, ensuring maintenance stability.

## MVP Scope

### Core Features (Phase 1)
*   **The Prism Engine:** A versioned Composer package (`nsakib176/prism`) containing the base Jigsaw scaffolding and Tailwind JIT configuration.
*   **Dynamic Component System:** A library of shared Blade components (Header, Footer, Hero, ProductGrid, FeatureSection) that adapt to config variables.
*   **Preset 1: "Clinical":** A complete visual theme optimized for Vitamin/Supplement brands (Clean, Medical, Trustworthy).
*   **Compliance Mode: "Supplements":**
    *   Automatic injection of standard FDA Disclaimers in the footer.
    *   "Supplement Facts" table component for product pages.
*   **Reference Implementation:** A functional "Thin Repository" (e.g., `vital-core-labs`) acting as the template for future sites.

### Out of Scope for MVP
*   **Additional Presets:** Playful (Pet), Luxury (Artisanal), and Organic themes are deferred to Phase 2.
*   **Advanced Compliance:** AAFCO (Pet Food) and Cosmetics regulations are deferred.
*   **Automated CI/CD:** Automated GitHub Actions for multi-site deployment (builds will be run manually via CLI initially).
*   **Blog/Content Modules:** Focus strictly on "Brand Home" + "Product Landing Pages."
*   **Lead Magnet Integration:** Deferred to v1.1 to focus on core visual engine first.

### MVP Success Criteria
*   **Successful Build:** The Reference Implementation compiles without errors using `composer update` and `npm run build`.
*   **Visual Validation:** The "Clinical" preset renders correctly with user-defined colors from `config.php`.
*   **Compliance Check:** FDA Disclaimers appear automatically when `compliance.mode` is set to 'supplements'.

### Future Vision
*   **The "Preset Store":** Expansion to 10+ niche presets (Car Parts, Real Estate, Law Firms).
*   **SaaS-ification:** Building a GUI dashboard so non-technical users can configure their `config.php` without touching code.
*   **Direct-to-Amazon:** API integration to pull live pricing and stock status from Amazon Seller Central.
