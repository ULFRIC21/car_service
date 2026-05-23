

<?php $__env->startSection('title', 'Мои записи'); ?>

<?php $__env->startSection('content'); ?>
<h1>Мои записи</h1>

<p><a href="<?php echo e(route('appointments.create')); ?>">+ Новая запись</a></p>

<?php if($appointments->isEmpty()): ?>
    <p class="simple-muted">Записей нет. <a href="<?php echo e(route('appointments.create')); ?>">Создать первую</a></p>
<?php else: ?>
    <table class="simple-table">
        <thead>
            <tr>
                <th>Услуга</th>
                <th>Дата</th>
                <th>Статус</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($a->service->name); ?></td>
                    <td><?php echo e($a->scheduled_at->format('d.m.Y H:i')); ?></td>
                    <td><?php echo e($a->status_label); ?></td>
                    <td>
                        <?php if(in_array($a->status, ['pending', 'confirmed'])): ?>
                            <form action="<?php echo e(route('appointments.destroy', $a)); ?>" method="POST" style="display:inline" onsubmit="return confirm('Отменить запись?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="simple-link-btn">Отменить</button>
                            </form>
                        <?php else: ?>
                            —
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.client', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Program Files\Ampps\www\car_service\resources\views/appointments/index.blade.php ENDPATH**/ ?>