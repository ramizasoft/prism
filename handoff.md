## AI agent handoff: Build an Amazon pet-toy brand site with Prism

This runbook is written for an AI agent to execute end-to-end on Windows (PowerShell), using Prism to scaffold a **thin-client** site for an Amazon brand seller in the **pet toy** niche.

### Goals
- Create a new Prism client repo in a fresh folder.
- Use a **Playful** theme preset (pet-toy vibe).
- Use **no compliance mode** (pet toys are not `pet_food`).
- Add 2–3 sample products with **Amazon “Buy” CTAs**.
- Build + preview locally.

---

## 0) Prerequisites (verify installed)
- PHP 8.2+
- Composer
- Node.js + npm
- Git (optional, but recommended)

---

## 1) Create the project folder
Pick a workspace folder where you keep client sites.

```powershell
cd C:\wamp64\www\RamizaSoft
mkdir client-pet-toy-brand
cd client-pet-toy-brand
```

---

## 2) Install Prism CLI (global)
If Prism is not installed globally yet:

```powershell
composer global require ramizasoft/prism
```

Make sure Composer global binaries are on PATH (so `prism` works). If `prism` is not recognized:
- Confirm Composer global bin path and add it to PATH (commonly `%APPDATA%\Composer\vendor\bin` on Windows).

---

## 3) Initialize the Thin Client site (in the current folder)
Run Prism init wizard:

```powershell
prism init "PawJoy Toys"
```

When prompted, choose:
- **Theme preset**: `playful-paws` (or `playful`, `playful-boing`, `playful-threads`)
- **Compliance mode**: `none`
- **Primary brand color**: pick the brand primary (example: `#FF4D6D`)

Expected files/folders created:
- `config.php`
- `bootstrap.php`
- `composer.json`
- `package.json`
- `vite.config.js`
- `tailwind.config.js`
- `postcss.config.js`
- `.gitignore`
- `source/`
  - `index.blade.php`
  - `_products/example-product.md`

---

## 4) Install dependencies
```powershell
composer install
npm install
```

---

## 5) Configure the site (edit `config.php`)
Open `config.php` and confirm it looks like this shape (pet-toy brands should use `compliance_mode: 'none'`):

```php
<?php

use Prism\Core\Prism;

return Prism::configure(
    project_name: 'PawJoy Toys',
    theme_preset: 'playful-paws',
    compliance_mode: 'none',
    brand_colors: [
        'primary' => '#FF4D6D',
        'secondary' => '#0f172a',
    ],
    niche: null,
);
```

Notes:
- If `niche` exists as an array, set it to `null` for `compliance_mode: 'none'`.
- If you change `theme_preset`, you must rebuild frontend assets (step 7).

---

## 6) Create the pages needed for an Amazon brand seller
In `source/`, create these files (content can be minimal at first):
- `about.md`
- `faq.md`
- `support.md`

Suggested front matter for simple markdown pages:

```md
---
extends: prism::layouts.app
title: About
---

# About PawJoy Toys

Write your brand story, quality promise, and what makes the toys safe and fun.
```

For **support/contact**, keep it static by default (safe for static hosting):
- support email
- Amazon order-help instructions
- returns guidance (link to Amazon returns if applicable)

---

## 7) Add products (Amazon CTAs)
Create 2–3 product Markdown files in `source/_products/`:

- `source/_products/squeaky-duck.md`
- `source/_products/tug-rope.md`
- `source/_products/treat-ball.md`

Example product file:

```md
---
extends: prism::layouts.app
title: "Squeaky Duck Toy"
description: "Durable squeaker toy designed for fetch and chew sessions."
sku: "PJ-DUCK-001"
price: 12.99
amazon_link: "https://amazon.com/dp/REPLACE_ME"
---

# Squeaky Duck Toy

Add benefit-led copy, materials, size info, and safety notes (e.g., supervise play).

<div class="mt-8 flex flex-wrap items-center gap-3">
  <a class="inline-flex items-center justify-center rounded-md bg-primary px-4 py-2 font-semibold text-secondary hover:opacity-90"
     href="{{ $page->amazon_link }}"
     rel="nofollow noopener"
     target="_blank"
  >
    Buy on Amazon
  </a>
  <span class="text-sm opacity-70">Ships & sold on Amazon.</span>
</div>
```

---

## 8) Update the homepage (`source/index.blade.php`)
Ensure your homepage:
- clearly explains the brand
- shows 2–3 hero benefits
- displays a small product grid (links to product pages)

If you want a quick product grid without dynamic collections, hardcode links that match your product slugs:
- `/products/squeaky-duck`
- `/products/tug-rope`
- `/products/treat-ball`

---

## 9) Build assets + build the site
Run the combined dev build:

```powershell
npm run dev
```

This should:
- run Vite build to generate `source/assets/build/manifest.json`
- run `php vendor/bin/prism build`

For a production build:

```powershell
npm run build
```

---

## 10) Preview locally
```powershell
npm run preview
```

If port 8000 is busy:

```powershell
php vendor/bin/prism serve --port=8080
```

---

## 11) “Done” checklist (what the AI agent should confirm)
- `config.php` validates and builds (no build-time config errors).
- Theme preset CSS loads (page source includes `/assets/build/<preset>.css`).
- Product pages render and “Buy on Amazon” links open in a new tab.
- Footer exists and nav links work.
- About/FAQ/Support pages exist and render.

