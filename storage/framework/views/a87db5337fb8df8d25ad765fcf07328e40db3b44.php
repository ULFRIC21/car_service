

<?php $__env->startSection('title', 'Новая услуга'); ?>

<?php $__env->startSection('content'); ?>
<h1>Новая услуга</h1>

<form method="POST" action="<?php echo e(route('admin.services.store')); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo $__env->make('admin.services._form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <button type="submit" class="btn btn-primary">Сохранить</button>
    <a href="<?php echo e(route('admin.services.index')); ?>">Отмена</a>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Program Files\Ampps\www\car_service\resources\views/admin/services/create.blade.php ENDPATH**/ ?>