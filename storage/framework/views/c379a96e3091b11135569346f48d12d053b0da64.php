<?php if(session('status')): ?>
    <div class="alert alert-success alert-dismissible fade show container mt-3 mb-0" role="alert">
        <?php echo e(session('status')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
    </div>
<?php endif; ?>
<?php /**PATH C:\Program Files\Ampps\www\car_service\resources\views/partials/flash.blade.php ENDPATH**/ ?>