---
project_name: 'Prism (Brand Factory Generator)'
date: '2025-12-25'
sections_completed: ['technology_stack', 'language_rules', 'framework_rules', 'testing_rules', 'style_rules', 'workflow_rules', 'critical_rules']
---

# Project Context: VitalCore Labs

## Mission
Build a high-performance, static site generator platform for Amazon sellers to achieve brand verification and own their audience.

## Technology Stack & Versions

- **PHP:** 8.2+ (Strict typing required)
- **Jigsaw (SSG):** v1.8.3 (Vite-enabled)
- **Laravel Zero:** v12.x (CLI Engine)
- **Tailwind CSS:** JIT Mode
- **Spatie Laravel Data:** v4.18.0 (for DTOs)
- **Pest PHP:** Latest (Testing)
- **Vite:** Latest (Asset compilation)

## Critical Implementation Rules

### Language-Specific Rules (PHP 8.2+)

- **Strict Mode:** Always include `declare(strict_types=1);` at the top of every PHP file.
- **Type Safety:** 
    - All properties, parameters, and return types must be explicitly hinted.
    - Avoid `docblock` types if native types are available.
- **Immutability:** Use `readonly` classes for all DTOs (Spatie Data objects).
- **Clean Code:** Use Constructor Property Promotion to reduce boilerplate in classes.

### Framework-Specific Rules (Jigsaw & Laravel Zero)

- **Blade Namespacing:** Core components MUST be namespaced as `prism::`. Usage: `<x-prism::component />`.
- **Config Source of Truth:** 
    - Always use the `PrismConfig` DTO (Spatie Data) for logic.
    - Avoid raw `config()` or array access in Blade/Engine logic.
- **Factory Pattern Enforcement:**
    - The Engine is a read-only dependency for Client repos.
    - No client-specific logic allowed in the `prism` core package.
- **Theming:** Use CSS variables (`--prism-*`) in core CSS; values must be injected from `config.php` branding settings.

### Testing Rules (Pest PHP)

- **Style:** Use Pest functional testing (`test()` or `it()`).
- **Arch Testing:** Use Pest Arch to enforce architectural boundaries (e.g., namespaces, dependency directions).
- **Compliance Coverage:** Each regulatory requirement must have a test verifying correct content injection.
- **Fail-Fast Validation:** Test the DTOs to ensure invalid configurations stop the build process.
- **Isolated Components:** Test core Blade components using isolated view rendering tests.

### Code Quality & Style Rules

- **PSR Compliance:** Follow PSR-12 strictly.
- **Naming Conventions:**
    - Classes/Interfaces: `PascalCase`.
    - Methods/Properties: `camelCase`.
    - Config Keys: `snake_case`.
    - Blade Component Files: `kebab-case`.
- **Self-Documenting Code:** Favor expressive variable/method names over extensive comments.
- **Single Responsibility:** Each class and method should do one thing well.

### Development Workflow Rules

- **SemVer:** Always follow Semantic Versioning for core engine releases.
- **Fleet Management:** Updates to client sites must only be handled via the `prism update:all` command.
- **Build Pipeline:** Validation MUST run before build; Build MUST run before deploy.
- **Thin Repo Integrity:** Ensure no PHP logic files (other than `config.php`) are committed to client repositories.

### Critical Don't-Miss Rules (Anti-Patterns)

- **No Hardcoded Disclaimers:** All regulatory text MUST reside in the core engine's configuration or translation files.
- **Client Logic Bleed:** Do NOT implement custom logic in client repos. If a client needs a new feature, abstract it into the `prism` core as a toggle or preset.
- **Performance First:** 100/100 Lighthouse is non-negotiable. Avoid large JS libraries or unoptimized assets.
- **Broken Build Protection:** Build-time validation is the gatekeeper. Never bypass DTO validation to "fix" a build.
- **Path Safety:** Always use relative paths or Jigsaw-provided path helpers to ensure the engine works correctly when installed as a Composer dependency.

## Project Architecture & Patterns
The project follows a **'Factory Pattern'** for web development, separating the design engine from client instances.

### 1. The Design Engine (`prism`)
- A versioned Composer package containing shared logic, components, and presets.
- **Dynamic Presets:** Supports multiple 'vibes' (Clinical, Playful, Luxury, Organic) via configuration.
- **Tailwind JIT Styling:** Uses CSS variables injected from client config for instant branding changes.
- **Component Variants:** Blade components that adapt layout based on the active preset.

### 2. The Client Instance (Thin Repository)
- Lightweight Git repository for each client.
- **Dependency:** Requires `prism` via Composer.
- **Content:** Contains only client-specific assets (logo, colors) and product Markdown files.
- **Configuration:** `config.php` acts as the 'brain,' defining niche, colors, and features.

## Core Features
- **Multi-Niche Presets:** Clinical (Vitamins), Playful (Pet Products), Luxury (Artisanal), Organic.
- **Compliance Mode:** 
    - **Supplements:** Injects FDA disclaimers and Supplement Facts panels.
    - **Pet Food:** Injects AAFCO statements and Guaranteed Analysis tables.
- **Lead Magnet Integration:** Integrated email acquisition to own the audience.
- **Amazon-First Design:** Optimized 'Buy on Amazon' CTAs and Brand Registry compliance.

## Business Logic & Domain Rules
- **Static-First:** Everything must compile to static HTML for speed and security.
- **Accessibility-Compliant:** High standards for professional, accessible UI.
- **Regulatory-Compliant:** Built-in support for industry-specific legal requirements (FDA, AAFCO).
- **Maintenance Pattern:** Update the core theme package to push fixes/features to all 50+ client instances simultaneously.

## Critical Implementation Rules for AI Agents
- **Separation of Concerns:** Never put client-specific logic in the `prism` package.
- **Configuration-Driven:** Use `config.php` in the client instance to drive theme behavior.
- **Performance:** Ensure 100/100 speed scores by keeping the output static and optimized.
- **Compliance First:** Always check the `compliance.mode` in `config.php` when rendering product or legal components.
