

<?php $__env->startSection('title', 'Услуги'); ?>

<?php $__env->startSection('content'); ?>
<h1>Услуги</h1>
<p><a href="<?php echo e(route('admin.services.create')); ?>">+ Добавить</a></p>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Цена</th>
            <th>Мин</th>
            <th>Активна</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($service->id); ?></td>
                <td><?php echo e($service->name); ?></td>
                <td><?php echo e($service->price); ?></td>
                <td><?php echo e($service->duration_minutes); ?></td>
                <td><?php echo e($service->is_active ? 'да' : 'нет'); ?></td>
                <td>
                    <a href="<?php echo e(route('admin.services.edit', $service)); ?>">Изменить</a>
                    <form action="<?php echo e(route('admin.services.destroy', $service)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Удалить?');">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit">Удалить</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="6">Нет услуг</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<?php echo e($services->links()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Program Files\Ampps\www\car_service\resources\views/admin/services/index.blade.php ENDPATH**/ ?>