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
- **Dependency:** Requires `nsakib176/prism`.
- **Content:** Only contains the client's logo, brand colors, and product Markdown files.
- **Maintenance:** Update all 50 clients by bumping the version in `composer.json` and redeploying.

---

# The "Pro" Stack: Jigsaw + Tailwind UI + Composer

- **Jigsaw:** Compiles everything to static HTML (Instant load, unhackable).
- **Tailwind UI:** High-quality, professional components.
- **Composer:** Manages the shared theme logic across all clients.

## Project Structure

### Theme Package (`prism/`)
```plaintext
/source
  /_assets/css/presets/
    clinical.css   <-- For Vitamins
    playful.css    <-- For Pet Products
    luxury.css     <-- For Homemade/Artisanal
  /_components/
    header.blade.php
    hero.blade.php (supports modes: 'bold', 'minimal', 'center')
    ...
```

### Client Site (`client-site-a/`)
```plaintext
composer.json        <-- requires "yourname/brand-factory-theme"
config.php           <-- THE "BRAIN" (Niche, Colors, Features)
/source
  /_assets/images/
    logo.svg
  /_products/
    vitamin-c.md     <-- Client specific products
```

---

## Step-by-Step Configuration

You define the client's identity and **niche preset** in `config.php`.

```php
return [
    'theme_preset' => 'clinical', // Options: clinical, playful, luxury, organic
    'brand' => [
        'name' => 'VitalCore Labs',
        'colors' => [
            'primary' => '#0F172A',
            'accent' => '#0EA5E9',
        ],
        'amazon_url' => '...',
    ],
    'features' => [
        'show_lead_magnet' => true,
        'show_blog' => false,
    ],
];
```

---

# Industry Compliance Architecture

To handle diverse regulatory requirements without bloating the core code, we use a **"Compliance Mode"** strategy. This ensures that a Vitamin site looks and acts like a medical brand, while a Pet Food site follows animal nutrition standards.

## 1. Compliance Configuration
The client's `config.php` defines the regulatory context:
```php
'compliance' => [
    'mode' => 'supplements', // Options: supplements, pet_food, cosmetics, general
    'disclaimer' => '...',    // Optional override for standard text
],
```

## 2. Smart Component Injection
The theme package uses this mode to toggle specific structural blocks:
- **Supplements Mode:** Injects the mandatory FDA "Shield" on all pages and enables the "Supplement Facts" panel on product pages.
- **Pet Food Mode:** Injects AAFCO nutritional adequacy statements and enables the "Guaranteed Analysis" table.
- **Cosmetics Mode:** Enables INCI ingredient listing and specific allergen warning blocks.

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

---

# Scaling Strategy

1.  **Phase 1 (The Master):** Build the `prism` with the first 3 presets (Clinical, Playful, Luxury).
2.  **Phase 2 (Automation):** Use a deployment script or GitHub Actions to trigger builds across all client repos when the theme package is updated.
3.  **Phase 3 (Expansion):** As you sign a client in a new niche (e.g., Car Parts), simply add a new preset to the theme package.

For a solo dev, this is the **"Factory Pattern"** for web development. You aren't building websites; you're operating a deployment factory.

 