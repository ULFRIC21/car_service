

<?php $__env->startSection('title', 'Клиенты'); ?>

<?php $__env->startSection('content'); ?>
<section class="admin-section">
    <h2>Нужно позвонить <span class="admin-muted">(<?php echo e($pending->count()); ?>)</span></h2>
    <?php if($pending->isEmpty()): ?>
        <p class="admin-empty">Новых регистраций нет.</p>
    <?php else: ?>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ФИО</th>
                    <th>Телефон</th>
                    <th>Email</th>
                    <th>Зарегистрирован</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $pending; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($client->full_name); ?></td>
                        <td><?php echo e($client->phone ?: '—'); ?></td>
                        <td><?php echo e($client->email); ?></td>
                        <td><?php echo e($client->created_at->format('d.m.Y H:i')); ?></td>
                        <td>
                            <form method="POST" action="<?php echo e(route('admin.clients.contacted', $client)); ?>">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>
                                <button type="submit" class="admin-btn">Позвонили</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endif; ?>
</section>

<section class="admin-section">
    <h2>Уже позвонили <span class="admin-muted">(<?php echo e($contacted->count()); ?>)</span></h2>
    <?php if($contacted->isEmpty()): ?>
        <p class="admin-empty">Пока никого не отмечали.</p>
    <?php else: ?>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ФИО</th>
                    <th>Телефон</th>
                    <th>Email</th>
                    <th>Звонок</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $contacted; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($client->full_name); ?></td>
                        <td><?php echo e($client->phone ?: '—'); ?></td>
                        <td><?php echo e($client->email); ?></td>
                        <td><?php echo e($client->contacted_at->format('d.m.Y H:i')); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endif; ?>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Program Files\Ampps\www\car_service\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>