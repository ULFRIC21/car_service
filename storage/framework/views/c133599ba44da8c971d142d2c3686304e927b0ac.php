

<?php $__env->startSection('title', 'Главная'); ?>

<?php $__env->startSection('content'); ?>
<h1>Панель администратора</h1>

<ul>
    <li>Услуги: <?php echo e($stats['services']); ?></li>
    <li>Пользователи: <?php echo e($stats['users']); ?></li>
    <li>Авто: <?php echo e($stats['vehicles']); ?></li>
    <li>Записи: <?php echo e($stats['appointments']); ?> (ожидают: <?php echo e($stats['pending']); ?>)</li>
</ul>

<p>
    <a href="<?php echo e(route('admin.services.index')); ?>">Услуги</a> |
    <a href="<?php echo e(route('admin.services.create')); ?>">+ Услуга</a> |
    <a href="<?php echo e(route('admin.appointments.index')); ?>">Записи</a>
</p>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Program Files\Ampps\www\car_service\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>