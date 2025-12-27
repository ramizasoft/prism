<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title' => 'Build your brand fast',
    'subtitle' => 'Launch high-converting pages in minutes.',
    'ctaLabel' => 'Get Started',
    'ctaHref' => '#',
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'title' => 'Build your brand fast',
    'subtitle' => 'Launch high-converting pages in minutes.',
    'ctaLabel' => 'Get Started',
    'ctaHref' => '#',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<section id="hero" class="bg-primary text-secondary">
    <div class="mx-auto flex max-w-5xl flex-col gap-4 px-4 py-12 sm:flex-row sm:items-center sm:justify-between">
        <div class="space-y-3">
            <h1 class="text-3xl font-bold sm:text-4xl"><?php echo e($title); ?></h1>
            <p class="text-base sm:text-lg text-secondary/90"><?php echo e($subtitle); ?></p>
            <?php echo e($slot); ?>

        </div>
        <div class="flex sm:flex-col gap-3">
            <a href="<?php echo e($ctaHref); ?>" class="inline-flex items-center justify-center rounded-md bg-secondary px-4 py-2 text-primary font-semibold shadow hover:opacity-90">
                <?php echo e($ctaLabel); ?>

            </a>
        </div>
    </div>
</section>

<?php /**PATH C:\wamp64\www\prism\resources\views/components/ui/hero.blade.php ENDPATH**/ ?>