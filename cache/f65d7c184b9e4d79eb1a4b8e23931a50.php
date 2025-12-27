<?php if (isset($component)) { $__componentOriginalb79861d466b42a0733988f8a0bcdd94e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb79861d466b42a0733988f8a0bcdd94e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'prism::components.layout.base','data' => ['page' => $page]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('prism::layout.base'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['page' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($page)]); ?>
    <title><?php echo e($page->title ?? 'Prism App'); ?></title>
    
    <div class="min-h-screen bg-white text-secondary font-sans antialiased">
        <header>
            <?php if (isset($component)) { $__componentOriginalb0136482265de1e35edaca6dace7ceea = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb0136482265de1e35edaca6dace7ceea = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'prism::components.ui.header','data' => ['logo' => ''.e($page->title ?? 'Prism').'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('prism::ui.header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['logo' => ''.e($page->title ?? 'Prism').'']); ?>
                <nav class="flex gap-4 text-sm font-medium">
                    <a class="text-secondary hover:underline" href="#hero">Hero</a>
                    <a class="text-secondary hover:underline" href="#products">Products</a>
                    <a class="text-secondary hover:underline" href="#footer">Footer</a>
                </nav>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb0136482265de1e35edaca6dace7ceea)): ?>
<?php $attributes = $__attributesOriginalb0136482265de1e35edaca6dace7ceea; ?>
<?php unset($__attributesOriginalb0136482265de1e35edaca6dace7ceea); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb0136482265de1e35edaca6dace7ceea)): ?>
<?php $component = $__componentOriginalb0136482265de1e35edaca6dace7ceea; ?>
<?php unset($__componentOriginalb0136482265de1e35edaca6dace7ceea); ?>
<?php endif; ?>
        </header>

        <main class="px-4 py-10">
            <?php echo $page->content; ?>

        </main>

        <footer id="footer">
            <?php if (isset($component)) { $__componentOriginalf0b734a020bb65fc0c0261575485468a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf0b734a020bb65fc0c0261575485468a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'prism::components.ui.footer','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('prism::ui.footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf0b734a020bb65fc0c0261575485468a)): ?>
<?php $attributes = $__attributesOriginalf0b734a020bb65fc0c0261575485468a; ?>
<?php unset($__attributesOriginalf0b734a020bb65fc0c0261575485468a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf0b734a020bb65fc0c0261575485468a)): ?>
<?php $component = $__componentOriginalf0b734a020bb65fc0c0261575485468a; ?>
<?php unset($__componentOriginalf0b734a020bb65fc0c0261575485468a); ?>
<?php endif; ?>
        </footer>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb79861d466b42a0733988f8a0bcdd94e)): ?>
<?php $attributes = $__attributesOriginalb79861d466b42a0733988f8a0bcdd94e; ?>
<?php unset($__attributesOriginalb79861d466b42a0733988f8a0bcdd94e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb79861d466b42a0733988f8a0bcdd94e)): ?>
<?php $component = $__componentOriginalb79861d466b42a0733988f8a0bcdd94e; ?>
<?php unset($__componentOriginalb79861d466b42a0733988f8a0bcdd94e); ?>
<?php endif; ?>

<?php /**PATH C:\wamp64\www\prism\resources\views/layouts/app.blade.php ENDPATH**/ ?>