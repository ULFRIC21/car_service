<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Добавить авто</h1>
    <?php if($errors->any()): ?>
        <div class="alert alert-danger"><ul class="mb-0"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul></div>
    <?php endif; ?>
    <form method="POST" action="<?php echo e(route('vehicles.store')); ?>">
        <?php echo csrf_field(); ?>
        <?php echo $__env->make('vehicles._form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <button type="submit" class="btn btn-primary">Сохранить</button>
        <a href="<?php echo e(route('vehicles.index')); ?>" class="btn btn-secondary">Отмена</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Program Files\Ampps\www\car_service\resources\views/vehicles/create.blade.php ENDPATH**/ ?>