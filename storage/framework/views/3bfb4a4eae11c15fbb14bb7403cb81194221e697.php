<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Мои авто</h1>
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <p><a href="<?php echo e(route('vehicles.create')); ?>" class="btn btn-primary btn-sm">+ Добавить авто</a>
       <a href="<?php echo e(route('home')); ?>" class="btn btn-secondary btn-sm">На главную</a></p>

    <table class="table table-bordered">
        <thead>
            <tr><th>Марка</th><th>Модель</th><th>Номер</th><th></th></tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($vehicle->brand); ?></td>
                    <td><?php echo e($vehicle->model); ?></td>
                    <td><?php echo e($vehicle->plate_number); ?></td>
                    <td>
                        <a href="<?php echo e(route('vehicles.edit', $vehicle)); ?>" class="btn btn-sm btn-outline-primary">Изменить</a>
                        <form action="<?php echo e(route('vehicles.destroy', $vehicle)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Удалить?');">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-sm btn-outline-danger">Удалить</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="4">Нет авто</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Program Files\Ampps\www\car_service\resources\views/vehicles/index.blade.php ENDPATH**/ ?>