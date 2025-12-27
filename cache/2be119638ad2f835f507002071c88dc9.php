<?php if (isset($component)) { $__componentOriginal86d14d217aa8ff748593b0e2c845079a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal86d14d217aa8ff748593b0e2c845079a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'prism::components.ui.hero','data' => ['title' => 'Prism UI Kit','subtitle' => 'Reusable components powered by CSS variables.','ctaLabel' => 'Buy Now','ctaHref' => '#products']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('prism::ui.hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Prism UI Kit','subtitle' => 'Reusable components powered by CSS variables.','cta-label' => 'Buy Now','cta-href' => '#products']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal86d14d217aa8ff748593b0e2c845079a)): ?>
<?php $attributes = $__attributesOriginal86d14d217aa8ff748593b0e2c845079a; ?>
<?php unset($__attributesOriginal86d14d217aa8ff748593b0e2c845079a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal86d14d217aa8ff748593b0e2c845079a)): ?>
<?php $component = $__componentOriginal86d14d217aa8ff748593b0e2c845079a; ?>
<?php unset($__componentOriginal86d14d217aa8ff748593b0e2c845079a); ?>
<?php endif; ?>

<section id="products" class="mx-auto mt-10 grid max-w-5xl gap-6 px-4 sm:grid-cols-2">
    <?php if (isset($component)) { $__componentOriginal44f6961245e0e228a5a535db432b6bf6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal44f6961245e0e228a5a535db432b6bf6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'prism::components.ui.product-card','data' => ['title' => 'Vitamin Boost','price' => '$29.00','ctaLabel' => 'View Details']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('prism::ui.product-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Vitamin Boost','price' => '$29.00','cta-label' => 'View Details']); ?>
        Clean, potent daily vitamins to energize your routine.
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal44f6961245e0e228a5a535db432b6bf6)): ?>
<?php $attributes = $__attributesOriginal44f6961245e0e228a5a535db432b6bf6; ?>
<?php unset($__attributesOriginal44f6961245e0e228a5a535db432b6bf6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal44f6961245e0e228a5a535db432b6bf6)): ?>
<?php $component = $__componentOriginal44f6961245e0e228a5a535db432b6bf6; ?>
<?php unset($__componentOriginal44f6961245e0e228a5a535db432b6bf6); ?>
<?php endif; ?>

    <?php if (isset($component)) { $__componentOriginal44f6961245e0e228a5a535db432b6bf6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal44f6961245e0e228a5a535db432b6bf6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'prism::components.ui.product-card','data' => ['title' => 'Pet Wellness','price' => '$39.00','ctaLabel' => 'View Details']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('prism::ui.product-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Pet Wellness','price' => '$39.00','cta-label' => 'View Details']); ?>
        Formulated for healthy coats and happy pets.
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal44f6961245e0e228a5a535db432b6bf6)): ?>
<?php $attributes = $__attributesOriginal44f6961245e0e228a5a535db432b6bf6; ?>
<?php unset($__attributesOriginal44f6961245e0e228a5a535db432b6bf6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal44f6961245e0e228a5a535db432b6bf6)): ?>
<?php $component = $__componentOriginal44f6961245e0e228a5a535db432b6bf6; ?>
<?php unset($__componentOriginal44f6961245e0e228a5a535db432b6bf6); ?>
<?php endif; ?>
</section>


<?php echo $__env->make('prism::layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\prism/cache\08c1737598cc098e39514cb36fa3a43e2e191963.blade.php ENDPATH**/ ?>