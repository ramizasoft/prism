<?php
    /** @var \Prism\Core\Data\ConfigData $config */
    $config = app(\Prism\Core\Data\ConfigData::class);
    
    // ConfigData validation ensures 'niche' is populated if mode is 'supplements'
    // and that 'niche' will be of type SupplementsConfig which has 'fda_disclaimer'.
    $isSupplements = $config->compliance_mode === 'supplements';
    $disclaimer = $isSupplements && $config->niche instanceof \Prism\Core\Data\Niche\SupplementsConfig 
        ? $config->niche->fda_disclaimer 
        : null;
?>

<?php if($isSupplements && $disclaimer): ?>
    <div class="mt-6 border-t border-secondary/40 pt-4 text-sm text-secondary flex items-start gap-3">
        <?php if (isset($component)) { $__componentOriginal06f22cbcb148e3f7804e10df863167f0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal06f22cbcb148e3f7804e10df863167f0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'prism::components.compliance.badges.fda-shield','data' => ['class' => 'text-secondary shrink-0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('prism::compliance.badges.fda-shield'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-secondary shrink-0']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal06f22cbcb148e3f7804e10df863167f0)): ?>
<?php $attributes = $__attributesOriginal06f22cbcb148e3f7804e10df863167f0; ?>
<?php unset($__attributesOriginal06f22cbcb148e3f7804e10df863167f0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal06f22cbcb148e3f7804e10df863167f0)): ?>
<?php $component = $__componentOriginal06f22cbcb148e3f7804e10df863167f0; ?>
<?php unset($__componentOriginal06f22cbcb148e3f7804e10df863167f0); ?>
<?php endif; ?>
        <p><?php echo e($disclaimer); ?></p>
    </div>
<?php endif; ?><?php /**PATH C:\wamp64\www\prism\resources\views/components/compliance-footer.blade.php ENDPATH**/ ?>