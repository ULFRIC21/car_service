

<?php $__env->startSection('title', 'Личный кабинет'); ?>

<?php $__env->startSection('content'); ?>
<h1>Личный кабинет</h1>

<p>Здравствуйте, <strong><?php echo e(Auth::user()->full_name); ?></strong>.</p>
<p>
    Телефон: <?php echo e(Auth::user()->phone ?: 'не указан'); ?><br>
    Email: <?php echo e(Auth::user()->email); ?>

</p>

<h2>Разделы</h2>
<ul class="simple-list">
    <li><a href="<?php echo e(route('vehicles.index')); ?>">Мои автомобили</a> — <?php echo e($stats['vehicles']); ?> шт.</li>
    <li><a href="<?php echo e(route('appointments.index')); ?>">Мои записи</a> — всего <?php echo e($stats['total_appointments']); ?>, предстоящих <?php echo e($stats['upcoming_appointments']); ?></li>
    <li><a href="<?php echo e(route('appointments.create')); ?>">Записаться в сервис</a></li>
    <li><a href="<?php echo e(url('/')); ?>">Вернуться на главную сайта</a></li>
</ul>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.client', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Program Files\Ampps\www\car_service\resources\views/home.blade.php ENDPATH**/ ?>