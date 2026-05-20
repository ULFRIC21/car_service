<?php $__env->startSection('title', 'Запись #' . $appointment->id); ?>

<?php $__env->startSection('content'); ?>
<h1>Запись #<?php echo e($appointment->id); ?></h1>

<p><strong>Клиент:</strong> <?php echo e($appointment->user->name); ?> (<?php echo e($appointment->user->email); ?>)</p>
<p><strong>Авто:</strong> <?php echo e($appointment->vehicle->brand); ?> <?php echo e($appointment->vehicle->model); ?>, <?php echo e($appointment->vehicle->plate_number); ?></p>
<p><strong>Услуга:</strong> <?php echo e($appointment->service->name); ?> — <?php echo e($appointment->price_at_booking ?? $appointment->service->price); ?> ₽</p>
<p><strong>Дата:</strong> <?php echo e($appointment->scheduled_at->format('d.m.Y H:i')); ?></p>
<p><strong>Статус:</strong> <?php echo e($appointment->status_label); ?></p>
<?php if($appointment->client_comment): ?>
    <p><strong>Комментарий клиента:</strong> <?php echo e($appointment->client_comment); ?></p>
<?php endif; ?>

<hr>

<form method="POST" action="<?php echo e(route('admin.appointments.update-status', $appointment)); ?>">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PATCH'); ?>
    <div class="mb-2">
        <label>Статус</label>
        <select name="status" class="form-select">
            <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($value); ?>" <?php echo e($appointment->status === $value ? 'selected' : ''); ?>><?php echo e($label); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <div class="mb-2">
        <label>Мастер</label>
        <select name="mechanic_id" class="form-select">
            <option value="">— не назначен —</option>
            <?php $__currentLoopData = $mechanics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mechanic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($mechanic->id); ?>" <?php echo e($appointment->mechanic_id == $mechanic->id ? 'selected' : ''); ?>><?php echo e($mechanic->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <div class="mb-2">
        <label>Заметка админа</label>
        <textarea name="admin_comment" class="form-control" rows="2"><?php echo e(old('admin_comment', $appointment->admin_comment)); ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Обновить</button>
    <a href="<?php echo e(route('admin.appointments.index')); ?>">К списку</a>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Program Files\Ampps\www\car_service\resources\views/admin/appointments/show.blade.php ENDPATH**/ ?>