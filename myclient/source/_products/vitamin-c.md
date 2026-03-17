---
extends: prism::layouts.app
title: "Liposomal Vitamin C"
description: "High-absorption Vitamin C for immune support and antioxidant protection."
sku: "VIT-C-1000"
price: 29.99
amazon_link: "https://amazon.com/dp/B0XXXXXXXX"
supplement_facts:
  serving_size: "1 Capsule"
  servings_per_container: 60
  nutrients:
    - name: "Vitamin C (as Ascorbic Acid)"
      amount: "1000mg"
      dv_percent: 1111
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

Our Liposomal Vitamin C uses advanced delivery technology to ensure maximum absorption and bioavailability.

### Key Benefits
- **Immune Support:** Helps strengthen your body's natural defenses.
- **Antioxidant Power:** Fights free radicals and supports skin health.
- **High Absorption:** Gentle on the stomach with superior uptake.

### Suggested Use
Take one capsule daily with water, or as directed by your healthcare professional.

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
