---
extends: prism::layouts.app
title: Content Model (Pages + Products)
---
# Content Model (Pages + Products)

Prism client sites are **content-first**. You typically author:
- **Pages** in `source/` (`index.blade.php`, `about.md`, `faq.md`, etc.)
- **Products** in `source/_products/*.md` (one Markdown file per SKU)

Each page/product uses **front matter** (YAML at the top) for structured fields, plus Markdown/Blade for the body.

---

## Canonical product front matter (Amazon seller)
Recommended fields for each product file in `source/_products/<slug>.md`:

- **`title`**: string (product name)
- **`description`**: string (short summary)
- **`sku`**: string
- **`price`**: number
- **`amazon_link`**: string (the destination URL for your Amazon CTA)
- **`supplement_facts`**: object (only if you’re in `compliance_mode: supplements`)

### Example: supplements product

```md
---
extends: prism::layouts.app
title: "Liposomal Vitamin C"
description: "High-absorption Vitamin C for immune support and antioxidant protection."
sku: "VIT-C-1000"
price: 29.99
amazon_link: "https://amazon.com/dp/B0XXXXXXXX"
supplement_facts:
  serving_size: "1 Capsule"
  servings_per_container: "60"
  nutrients:
    - name: "Vitamin C"
      amount: "1000mg"
      dv_percent: 1111
      source: "as Ascorbic Acid"
    - name: "Sodium"
      amount: "10mg"
      dv_percent: "<1"
  proprietary_blends:
    - name: "Liposomal Matrix"
      amount: "50mg"
      ingredients:
        - "Phosphatidylcholine"
        - "Palmitic Acid"
        - "Oleic Acid"
---

# Liposomal Vitamin C

Benefit-led copy that matches your Amazon listing, but with stronger brand story and trust cues.

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

<div class="mt-10">
  <x-prism::supplement-facts :data="$page->supplement_facts" />
</div>
```

Notes:
- `dv_percent` maps directly to Prism’s DTO field (it can be a number, string like `"<1"`, or `null`).
- `proprietary_blends[*].ingredients` must be a **YAML list**, not a comma-separated string.

---

## Pet food products (recommended fields)
Prism’s **pet food compliance** requirements (AAFCO statement, safety messaging) live in `config.php` under `niche` when `compliance_mode: pet_food`.

For product pages, you can still keep a consistent structure:
- `title`, `description`, `sku`, `price`, `amazon_link`
- optional `ingredients`, `feeding_directions`, `size_options` (your own schema)

### Example: pet product

```md
---
extends: prism::layouts.app
title: "Salmon & Pumpkin Soft Chews"
description: "Digestive + skin support soft chews for adult dogs."
sku: "DOG-CHEW-SALMON"
price: 24.99
amazon_link: "https://amazon.com/dp/B0YYYYYYYY"
ingredients:
  - "Salmon"
  - "Pumpkin"
  - "Chicory root"
feeding_directions: "Up to 1 chew per 25 lbs of body weight daily."
---

# Salmon & Pumpkin Soft Chews

Use this space for brand story, quality proof, and gentle CTAs back to Amazon.
```

Start simple and evolve once your catalog needs it.

