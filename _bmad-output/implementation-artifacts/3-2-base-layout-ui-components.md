# Story 3.2: Base Layout & UI Components

Status: review

<!-- Note: Validation is optional. Run validate-create-story for quality check before dev-story. -->

## Story

As an Implementation Specialist,
I want a set of standard UI components (Header, Footer, Hero, Product Card),
so that I can build pages quickly.

## Acceptance Criteria

1. [x] Create a reusable Blade layout `resources/views/layouts/app.blade.php`.
2. [x] Create namespaced UI components:
    - `x-prism::ui.header`
    - `x-prism::ui.footer`
    - `x-prism::ui.hero`
    - `x-prism::ui.product-card`
3. [x] Components must use the Tailwind utility classes mapped to the CSS variables defined in Story 3.1.
4. [x] Components must be responsive (mobile-first).
5. [x] Components must allow slot content where appropriate.
6. [x] Demonstrate usage in a sample page.

## Tasks / Subtasks

- [x] Create Layout (AC: 1)
  - [x] `resources/views/layouts/app.blade.php`
  - [x] Include the `<x-prism::layout.base />` created in Story 3.1.
  - [x] Add basic HTML structure (header, main, footer).
- [x] Create UI Components (AC: 2, 3, 4, 5)
  - [x] `Header`: Logo (from config), Navigation links.
  - [x] `Footer`: Copyright, Links, Compliance Footer placeholder.
  - [x] `Hero`: Headline, Subheadline, CTA button.
  - [x] `ProductCard`: Image, Title, Price, "View Details" button.
- [x] Component Styling (AC: 3)
  - [x] Use `bg-primary`, `text-secondary`, etc. to ensure theming works.
- [x] Testing (AC: 6)
  - [x] Create a dummy page using these components.
  - [x] Verify rendering contains correct classes and structure.

## Dev Notes

- **Naming:** Keep components in `ui` subdirectory to avoid cluttering the root namespace. `x-prism::ui.button` is better than `x-prism::button`.
- **Flexibility:** Use `$attributes->merge()` to allow overriding classes from the consumer side.
- **Config Access:** Components can access `ConfigData` singleton if needed (e.g. for logo URL), but passing props is often cleaner for UI components.

### Project Structure Notes

- `resources/views/layouts/app.blade.php`
- `resources/views/components/ui/`

### References

- [Source: _bmad-output/implementation-artifacts/3-1-css-variable-injection-engine.md]
- [Source: project-context.md#Framework-Specific Rules (Jigsaw & Laravel Zero)]

## Dev Agent Record

### Agent Model Used

gpt-5.1-codex-max

### Debug Log References

- Implemented base layout and UI components leveraging CSS variable theming from Story 3.1.
- Added feature coverage to verify generated HTML includes theming classes and component structures.

### Completion Notes List

- Created `resources/views/layouts/app.blade.php` wrapping content with `x-prism::layout.base`.
- Added UI components (`header`, `footer`, `hero`, `product-card`) under `prism::ui` namespace using Tailwind classes tied to CSS vars.
- Added sample page to demonstrate components and confirm usage.
- Added feature test to build with Jigsaw and assert rendered theming variables and component markup.

### File List

- resources/views/layouts/app.blade.php
- resources/views/components/ui/header.blade.php
- resources/views/components/ui/footer.blade.php
- resources/views/components/ui/hero.blade.php
- resources/views/components/ui/product-card.blade.php
- source/ui-demo.blade.php
- tests/Feature/UIComponentsTest.php
- _bmad-output/implementation-artifacts/sprint-status.yaml
