<?php $__env->startSection('title', 'Записи'); ?>

<?php $__env->startSection('content'); ?>
<h1>Записи</h1>

<form method="GET" class="mb-3">
    <select name="status" class="form-select d-inline-block w-auto">
        <option value="">Все статусы</option>
        <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($value); ?>" <?php echo e(request('status') === $value ? 'selected' : ''); ?>><?php echo e($label); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <button type="submit">Фильтр</button>
</form>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Клиент</th>
            <th>Авто</th>
            <th>Услуга</th>
            <th>Дата</th>
            <th>Статус</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($appointment->id); ?></td>
                <td><?php echo e($appointment->user->name); ?></td>
                <td><?php echo e($appointment->vehicle->brand); ?> <?php echo e($appointment->vehicle->model); ?> (<?php echo e($appointment->vehicle->plate_number); ?>)</td>
                <td><?php echo e($appointment->service->name); ?></td>
                <td><?php echo e($appointment->scheduled_at->format('d.m.Y H:i')); ?></td>
                <td><?php echo e($appointment->status_label); ?></td>
                <td><a href="<?php echo e(route('admin.appointments.show', $appointment)); ?>">Открыть</a></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="7">Записей нет</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<?php echo e($appointments->links()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Program Files\Ampps\www\car_service\resources\views/admin/appointments/index.blade.php ENDPATH**/ ?>