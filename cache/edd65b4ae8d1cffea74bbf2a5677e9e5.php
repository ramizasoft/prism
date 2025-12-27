<div class="bg-secondary text-primary">
    <div class="mx-auto flex max-w-5xl flex-col gap-2 px-4 py-6 text-sm sm:flex-row sm:items-center sm:justify-between">
        <div>&copy; <?php echo e(date('Y')); ?> <?php echo e($page->prism_project_name ?? 'Prism'); ?>. All rights reserved.</div>
        <div class="flex gap-4">
            <a class="hover:underline" href="#hero">Hero</a>
            <a class="hover:underline" href="#products">Products</a>
            <a class="hover:underline" href="#footer">Footer</a>
        </div>
    </div>
    <div class="mx-auto max-w-5xl px-4 pb-6">
        <?php if (isset($component)) { $__componentOriginal15086b24cd917327a0e1e9b968c06ab0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal15086b24cd917327a0e1e9b968c06ab0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'prism::components.compliance-footer','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('prism::compliance-footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal15086b24cd917327a0e1e9b968c06ab0)): ?>
<?php $attributes = $__attributesOriginal15086b24cd917327a0e1e9b968c06ab0; ?>
<?php unset($__attributesOriginal15086b24cd917327a0e1e9b968c06ab0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal15086b24cd917327a0e1e9b968c06ab0)): ?>
<?php $component = $__componentOriginal15086b24cd917327a0e1e9b968c06ab0; ?>
<?php unset($__componentOriginal15086b24cd917327a0e1e9b968c06ab0); ?>
<?php endif; ?>
    </div>
</div>

<?php /**PATH C:\wamp64\www\prism\resources\views/components/ui/footer.blade.php ENDPATH**/ ?>