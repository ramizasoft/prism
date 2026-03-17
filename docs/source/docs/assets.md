---
extends: prism::layouts.app
title: Assets (Vite + Tailwind)
---
# Assets (Vite + Tailwind)

Prism themes load a **preset CSS** file at runtime (based on `theme_preset`) via the Jigsaw `vite()` helper.

That means every thin-client site must build frontend assets so it has:
- `source/assets/build/manifest.json`
- hashed CSS output files in `source/assets/build/`

---

## How preset CSS is resolved
In the Prism base layout, the preset is determined from config-injected values:
- `theme_preset` in `config.php` → injected by `ThemeInjector` → available as `$page->prism_theme_preset`

The layout then attempts to load:
- `vendor/ramizasoft/prism/resources/assets/css/presets/<theme_preset>.css`
and uses the manifest to resolve the final hashed output URL under:
- `/assets/build/...`

---

## Required files in a client repo
When you run `prism init` (or `prism create:client`), the client will include:
- `vite.config.js`
- `tailwind.config.js`
- `postcss.config.js`
- `package.json` scripts

If you are wiring a client manually, copy these from the Prism starter template (`prism-starter/`) and then run:

```bash
npm install
```

---

## Common scripts (thin client)
From the client repo root:

```bash
# Build preset CSS + Jigsaw build (local)
npm run dev

# Build preset CSS + Jigsaw build (production)
npm run build

# Serve the built site locally
npm run preview
```

If you want faster iteration on CSS while writing content:

```bash
# terminal 1: watch assets
npm run assets:watch

# terminal 2: rebuild the site as needed
php vendor/bin/prism build
```

---

## Troubleshooting

### Manifest missing
If pages render but styling is missing, check that this exists:
- `source/assets/build/manifest.json`

Fix by running:

```bash
npm run assets:build
```

### Preset changed but CSS didn’t
If you changed `theme_preset` in `config.php`, rebuild assets:

```bash
npm run assets:build
php vendor/bin/prism build
```

