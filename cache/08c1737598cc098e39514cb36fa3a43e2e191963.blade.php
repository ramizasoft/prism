@extends('prism::layouts.app')
<x-prism::ui.hero
    title="Prism UI Kit"
    subtitle="Reusable components powered by CSS variables."
    cta-label="Buy Now"
    cta-href="#products"
/>

<section id="products" class="mx-auto mt-10 grid max-w-5xl gap-6 px-4 sm:grid-cols-2">
    <x-prism::ui.product-card
        title="Vitamin Boost"
        price="$29.00"
        cta-label="View Details"
    >
        Clean, potent daily vitamins to energize your routine.
    </x-prism::ui.product-card>

    <x-prism::ui.product-card
        title="Pet Wellness"
        price="$39.00"
        cta-label="View Details"
    >
        Formulated for healthy coats and happy pets.
    </x-prism::ui.product-card>
</section>

