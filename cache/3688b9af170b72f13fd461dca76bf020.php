<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title' => 'Product Name',
    'price' => '$99.00',
    'image' => 'https://via.placeholder.com/320x200',
    'ctaLabel' => 'View Details',
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
    'title' => 'Product Name',
    'price' => '$99.00',
    'image' => 'https://via.placeholder.com/320x200',
    'ctaLabel' => 'View Details',
    'ctaHref' => '#',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<article class="flex flex-col overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
    <img class="h-48 w-full object-cover" src="<?php echo e($image); ?>" alt="<?php echo e($title); ?>">
    <div class="flex flex-1 flex-col gap-3 p-4">
        <div>
            <h3 class="text-lg font-semibold text-primary"><?php echo e($title); ?></h3>
            <p class="text-sm text-secondary"><?php echo e($price); ?></p>
        </div>
        <div class="text-sm text-gray-700">
            <?php echo e($slot); ?>

        </div>
        <div class="mt-auto">
            <a href="<?php echo e($ctaHref); ?>" class="inline-flex items-center rounded-md bg-primary px-3 py-2 text-secondary font-semibold hover:opacity-90">
                <?php echo e($ctaLabel); ?>

            </a>
        </div>
    </div>
</article>

<?php /**PATH C:\wamp64\www\prism\resources\views/components/ui/product-card.blade.php ENDPATH**/ ?>