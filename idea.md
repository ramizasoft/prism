# Plan: Brand Factory Generator
Building a high-performance brand website generator for Amazon sellers across multiple niches (Vitamins, Pet Products, Homemade Goods, etc.).
**Primary Goal:** Rapid Amazon Brand Registry approval and customer email acquisition (owning the audience).

# The Architecture: "The Engine & The Instance"

To scale to 50+ clients without a maintenance nightmare, we separate the **Design Engine** from the **Client Instance**.

## 1. The Design Engine (Composer Package: `prism`)
One single, versioned PHP package containing all shared logic, components, and presets.
- **Dynamic Presets:** Supports multiple "vibes" (Clinical, Playful, Luxury, Organic) via configuration.
- **Tailwind JIT Styling:** Uses CSS variables injected from the client config to change colors, fonts, and spacing instantly.
- **Component Variants:** Blade components that adapt their layout based on the active preset.

## 2. The Client Instance (Thin Repository)
A lightweight Git repository for each client.
- **Dependency:** Requires `ramizasoft/prism`.
- **Content:** Only contains the client's logo, brand colors, and product Markdown files.
- **Maintenance:** Update all 50 clients by bumping the version in `composer.json` and redeploying.

---

# Industry Compliance & Niche Architecture

To handle diverse regulatory requirements without bloating the core code, we use a **"Compliance Mode"** strategy combined with **Polymorphic Configuration**.

## Supported Functional Niches (Compliance Modes)

1.  **Supplements (`supplements`)**
    *   **Features:** FDA Disclaimer injection, `SupplementFacts` panel (DSHEA compliant).
    *   **Trust Badges:** FDA Registered Facility, GMP Certified, Made in USA.

2.  **Pet Care (`pet_food`)**
    *   **Features:** AAFCO Statements, `SafetySection` with 'Vet Recommended' badge, Ingredient Integrity promise.
    *   **Target:** Pet food, calming chews, paw balms.

3.  **Cosmetics (`cosmetic`)**
    *   **Features:** `ScienceSection` using non-medical efficacy language ("Surface Texture", "Barrier Support").
    *   **Target:** Skincare, topicals, pimple patches.

4.  **Eco-Friendly (`eco`)**
    *   **Features:** `SustainabilitySection` highlighting mission statements and certifications (B-Corp, Climate Pledge Friendly).
    *   **Target:** Sustainable goods, reusable products.

5.  **Technology (`tech`)**
    *   **Features:** `SupportHub` with Manual Download and Video Guide links to reduce returns.
    *   **Target:** Gadgets, smart home devices, appliances.

6.  **Food & Grocery (`food`)**
    *   **Features:** `NutritionFacts` panel (FDA 21 CFR 101.9 compliant) with bold macro hierarchy.
    *   **Target:** Snacks, functional foods, beverages.

## Step-by-Step Configuration

You define the client's identity and **niche preset** in `config.php`.

```php
return [
    'project_name' => 'VitalCore Labs',
    'theme_preset' => 'clinical', // Visual Vibe: clinical, playful, luxury, organic
    'compliance_mode' => 'supplements', // Functional Logic
    'brand_colors' => [
        'primary' => '#0F172A',
        'secondary' => '#0EA5E9',
    ],
    // Niche-specific configuration (Polymorphic)
    'niche' => [
        'supplement_facts_format' => 'standard',
        'fda_disclaimer' => '...',
    ],
];
```

---

# Why this wins at scale?

1.  **Speed Score (100/100):** Static HTML is unbeatable.
2.  **One Bug Fix = 50 Updates:** Fix a bug in the header component in the theme package; run `composer update` on all client sites.
3.  **Amazon-First Compliance:** Built-in requirements for Brand Registry (FDA Disclaimers, ingredients lists, trust badges).
4.  **No Server Maintenance:** Hosted on cPanel. Shared cPanel for cheap costing. Can setup mail servers there too.

# The "Sales Pitch" to Any Niche

> "Most agencies build generic, slow WordPress sites that get hacked. I build **High-Performance Brand Assets**. 
> Whether you sell vitamins, pet food, or handmade candles, I provide a site that is:
> 1. **Amazon Approved:** Guaranteed compliance for Brand Registry.
> 2. **Lightning Fast:** Instant load times for better SEO and conversion.
> 3. **Future Proof:** You own your customer data via our integrated lead capture."