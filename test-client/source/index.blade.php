---
extends: prism::layouts.app
title: Welcome
---

<x-prism::ui.hero
    title="Prism Starter Site"
    subtitle="A thin-client brand site: fast, compliant, and built to send shoppers to Amazon."
    cta-label="Shop on Amazon"
    cta-href="#products"
/>

<section id="products" class="mx-auto mt-10 grid max-w-5xl gap-6 px-4 sm:grid-cols-2">
    <x-prism::ui.product-card
        title="Liposomal Vitamin C"
        price="$29.99"
        cta-label="View Details"
        cta-href="/products/vitamin-c"
    >
        High-absorption Vitamin C for immune support and antioxidant protection.
    </x-prism::ui.product-card>
</section>
