

<?php $__env->startSection('title', $service['title']); ?>

<?php $__env->startSection('content'); ?>
<section class="landing-section landing-section--light corporate-page service-page">
    <div class="landing-container">
        <h1 class="corporate-page__title"><?php echo e($service['title']); ?></h1>

        <div class="corporate-layout">
            <div class="corporate-main">
                <figure class="service-page__figure">
                    <img
                        src="<?php echo e(asset($service['image'])); ?>"
                        alt="<?php echo e($service['title']); ?>"
                        class="service-page__image"
                    >
                </figure>

                <div class="service-page__body">
                    <?php if ($__env->exists('pages.service.content.' . $slug)) echo $__env->make('pages.service.content.' . $slug, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>

                <p class="corporate-cta">
                    Записаться или уточнить:
                    <a href="tel:8800535353">8 800 535 353</a>
                </p>
                <p><a href="<?php echo e(url('/')); ?>" class="landing-link-back">← На главную</a></p>
            </div>

            <?php echo $__env->make('partials.services-sidebar', [
                'categories' => $categories,
                'linked' => true,
                'activeSlug' => $slug,
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.landing', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Program Files\Ampps\www\car_service\resources\views/pages/service/show.blade.php ENDPATH**/ ?>