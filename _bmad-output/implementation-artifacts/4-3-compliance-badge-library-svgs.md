# Story 4.3: Compliance Badge Library (SVGs)

Status: done

<!-- Note: Validation is optional. Run validate-create-story for quality check before dev-story. -->

## Story

As a Designer,
I want high-quality, verified SVGs for GMP/FDA badges,
so that the site looks professional and compliant.

## Acceptance Criteria

1. [x] A library of SVG components created in `resources/views/components/compliance/badges/`.
2. [x] Specific badges implemented:
    - [x] `x-prism::compliance.badges.gmp` (Good Manufacturing Practice)
    - [x] `x-prism::compliance.badges.fda-registered` (FDA Registered Facility - NOT the FDA logo itself)
    - [x] `x-prism::compliance.badges.made-in-usa`
3. [x] Badges scale correctly using Tailwind classes (e.g., `h-12 w-12`).
4. [x] Badges have accessible labels (title/desc tags in SVG or aria-label).

## Tasks / Subtasks

- [x] Create Badge Components (AC: 1, 2)
    - [x] `resources/views/components/compliance/badges/gmp.blade.php`
    - [x] `resources/views/components/compliance/badges/fda-registered.blade.php`
    - [x] `resources/views/components/compliance/badges/made-in-usa.blade.php`
- [x] Implement SVG Content (AC: 2)
    - [x] Use simple, clean geometric representations or standard open-source equivalents.
    - *Crucial:* Do NOT use the official FDA logo (it's restricted). Use a "FDA Registered Facility" badge design.
- [x] Styling and Accessibility (AC: 3, 4)
    - [x] Remove hardcoded width/height from SVG.
    - [x] Add `{{ $attributes }}` to the `<svg>` tag.
    - [x] Ensure `role="img"` and `aria-label` are present.
- [x] Testing
    - [x] Render all badges on a test page.
    - [x] Verify resizing with `w-20` vs `w-40`.

## Dev Notes

- **Legal Caution:** "FDA Registered" is a claim about the *facility*, not the *product*. Ensure the badge text reflects this distinction to protect the client.
- **Source Material:** Use generic "Stamp" style designs. Avoid trademarked elements.
- **Icon System:** These should be treated like icons—monotone or duotone—that can be colored via CSS (`text-primary`, etc.) if possible, or strictly colored if regulatory standard demands it.

### Project Structure Notes

- `resources/views/components/compliance/badges/`

### References

- [Source: _bmad-output/implementation-artifacts/4-1-automated-fda-disclaimer-injection.md]
- [Source: project-context.md#Compliance Requirements]

## Dev Agent Record

### Agent Model Used

gpt-5.1-codex-max

### Debug Log References

- Added SVG badge components for GMP, FDA Registered Facility, and Made in USA with accessible labels and attribute merging for sizing.
- Registered badge aliases in TemplateLoader for `x-prism::compliance.badges.*`.
- Ensured badges are monochrome, scalable via Tailwind width classes, and avoid restricted FDA logo usage.
- Created coverage test rendering all badges and asserting aria-labels and sizing class presence.

### Completion Notes List

- Implemented three compliance badge Blade components with accessible `role="img"` and default aria labels.
- Attribute merging keeps SVGs width/height free while allowing Tailwind sizing (e.g., `w-20`, `w-32`).
- Aliases registered in TemplateLoader for prism namespace resolution.
- Added feature test `ComplianceBadgesTest` validating rendering, labels, and sizing classes.
- Story status set to review; sprint-status updated.
- **Refactor (Adversarial Review):** Added `text` props for localization. Enforced `font-family="sans-serif"` on SVG text elements. Fixed test to verify text overrides.

### File List

- resources/views/components/compliance/badges/gmp.blade.php
- resources/views/components/compliance/badges/fda-registered.blade.php
- resources/views/components/compliance/badges/made-in-usa.blade.php
- src/Listeners/TemplateLoader.php
- tests/Feature/ComplianceBadgesTest.php
- _bmad-output/implementation-artifacts/sprint-status.yaml