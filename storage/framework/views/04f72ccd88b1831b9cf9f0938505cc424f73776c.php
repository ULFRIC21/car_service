

<?php $__env->startSection('title', 'Отзывы'); ?>

<?php $__env->startSection('content'); ?>
<section class="landing-section landing-section--light">
    <div class="landing-container page-content">
        <h1 class="page-content__title">Отзывы</h1>

        <div class="reviews-empty">
            <p>Пока отзывов нет.</p>
            <p class="reviews-empty__hint">Раздел открыт для просмотра. Оставить отзыв пока нельзя.</p>
        </div>

        <p><a href="<?php echo e(url('/')); ?>" class="landing-link-back">← На главную</a></p>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.landing', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Program Files\Ampps\www\car_service\resources\views/pages/reviews.blade.php ENDPATH**/ ?>