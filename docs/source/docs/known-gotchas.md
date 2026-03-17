---
extends: prism::layouts.app
title: Known Gotchas (Repository Notes)
---
# Known Gotchas (Repository Notes)

This page documents common issues and mismatches that can trip up developers when building thin-client sites with Prism.

---

## Resolved in this repository

### Thin-client preset CSS pathing
**Problem**: Thin clients build assets from `vendor/`, but layouts were referencing `resources/...` paths.\n
**Fix**: Prism base layouts now resolve preset CSS from `vendor/ramizasoft/prism/...` with a safe fallback for core-dev.\n
**Impact**: Clients can reliably build theme CSS using Vite and load it via manifest.\n

### Preview script calling a missing command
**Problem**: Starter template used `prism serve`, but the CLI did not implement `serve`.\n
**Fix**: Prism now includes a `serve` command that proxies `jigsaw serve`.\n

### Starter config + product front matter mismatches
**Problem**: Starter `config.php` and example product fields didn’t match Prism DTOs.\n
**Fix**: Starter content now matches the validated DTO shapes (e.g. `niche.fda_disclaimer`, `supplement_facts.dv_percent`, blend `ingredients` list).\n

### `update:all` package name mismatch
**Problem**: Fleet update used `composer update prism/core-engine`, but clients use `ramizasoft/prism`.\n
**Fix**: `update:all` now updates `ramizasoft/prism`.\n

---

## Still important to understand (not “bugs”)

### `_products/` is a convention, not magic by itself
Prism’s starter uses `source/_products/*.md` and links to `/products/<slug>`. How Jigsaw turns files into routes depends on the site’s content structure and (optionally) Jigsaw collection configuration.

Recommendation:\n
- Keep product pages in `source/_products/` as the standard.\n
- If you need advanced catalog pages (sorting/filtering/index pages), add a dedicated catalog page and render cards that link to the product slugs.\n

### Compliance modes are validated
If you set `compliance_mode: 'supplements'` or `pet_food`, Prism will require the correct `niche` fields. This is intentional and prevents broken deploys.

