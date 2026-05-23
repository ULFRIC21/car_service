<aside class="corporate-sidebar service-sidebar" aria-label="Услуги автосервиса">
    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="corporate-service-block service-sidebar__block">
            <h2 class="corporate-service-block__title"><?php echo e($category['title']); ?></h2>
            <ul class="corporate-service-block__list service-sidebar__list">
                <li>
                    <a
                        href="<?php echo e(route('services.show', $category['slug'])); ?>"
                        class="service-sidebar__link <?php echo e($activeSlug === $category['slug'] ? 'is-active' : ''); ?>"
                    >Обзор раздела</a>
                </li>
                <?php $__currentLoopData = $category['pages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <a
                            href="<?php echo e(route('services.show', $page['slug'])); ?>"
                            class="service-sidebar__link <?php echo e($activeSlug === $page['slug'] ? 'is-active' : ''); ?>"
                        ><?php echo e($page['title']); ?></a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</aside>
<?php /**PATH C:\Program Files\Ampps\www\car_service\resources\views/partials/service-sidebar.blade.php ENDPATH**/ ?>