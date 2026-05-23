<aside class="corporate-sidebar" aria-label="Услуги автосервиса">
    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="corporate-service-block">
            <h3 class="corporate-service-block__title"><?php echo e($category['title']); ?></h3>
            <ul class="corporate-service-block__list <?php echo e(!empty($linked) ? 'corporate-service-block__list--links' : ''); ?>">
                <?php if(!empty($linked)): ?>
                    <?php $__currentLoopData = $category['pages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a
                                href="<?php echo e(route('services.show', $page['slug'])); ?>"
                                class="service-sidebar__link <?php echo e(($activeSlug ?? '') === $page['slug'] ? 'is-active' : ''); ?>"
                            ><?php echo e($page['title']); ?></a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <?php $__currentLoopData = $category['pages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($page['title']); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </ul>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</aside>
<?php /**PATH C:\Program Files\Ampps\www\car_service\resources\views/partials/services-sidebar.blade.php ENDPATH**/ ?>