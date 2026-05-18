

<?php $__env->startSection('title', 'Главная'); ?>

<?php $__env->startSection('content'); ?>
<h1>Панель администратора</h1>

<div class="mb-3">
    <a href="#" class="btn btn-primary">+ Добавить услугу</a>
    <a href="#" class="btn btn-secondary">Все услуги</a>
    <a href="#" class="btn btn-outline-secondary">Записи</a>
</div>

<p class="text-muted">Вход для админа: admin@car-service.local / password</p>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Program Files\Ampps\www\car_service\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>