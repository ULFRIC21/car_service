<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card">
        <div class="card-header">Личный кабинет</div>
        <div class="card-body">
            <?php if(session('status')): ?>
                <div class="alert alert-success"><?php echo e(session('status')); ?></div>
            <?php endif; ?>
            <?php if(session('success')): ?>
                <div class="alert alert-success"><?php echo e(session('success')); ?></div>
            <?php endif; ?>

            <p>Привет, <?php echo e(Auth::user()->name); ?>.</p>

            <?php if(Auth::user()->isAdmin()): ?>
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-dark btn-sm">Админка</a>
            <?php endif; ?>

            <a href="<?php echo e(route('vehicles.index')); ?>" class="btn btn-primary btn-sm">Мои авто</a>
            <a href="<?php echo e(route('vehicles.create')); ?>" class="btn btn-outline-primary btn-sm">+ Авто</a>
            <a href="<?php echo e(route('appointments.index')); ?>" class="btn btn-primary btn-sm">Мои записи</a>
            <a href="<?php echo e(route('appointments.create')); ?>" class="btn btn-outline-primary btn-sm">+ Запись</a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Program Files\Ampps\www\car_service\resources\views/home.blade.php ENDPATH**/ ?>