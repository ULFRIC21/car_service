<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Личный кабинет'); ?> — Тех Эксперт</title>
    <link href="<?php echo e(asset('css/simple.css')); ?>" rel="stylesheet">
</head>
<body class="simple-page">
<header class="simple-top">
    <div class="simple-top__row">
        <a href="<?php echo e(url('/')); ?>" class="simple-brand">Тех Эксперт</a>
        <div>
            <a href="<?php echo e(url('/')); ?>">Главная</a>
            &nbsp;|&nbsp;
            <a href="tel:8800535353">8 800 535 353</a>
            &nbsp;|&nbsp;
            <a href="<?php echo e(route('logout')); ?>"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a>
            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display:none"><?php echo csrf_field(); ?></form>
        </div>
    </div>
    <nav class="simple-nav">
        <a href="<?php echo e(route('home')); ?>">Кабинет</a>
        <a href="<?php echo e(route('vehicles.index')); ?>">Мои автомобили</a>
        <a href="<?php echo e(route('appointments.index')); ?>">Мои записи</a>
        <a href="<?php echo e(route('appointments.create')); ?>">Записаться</a>
    </nav>
</header>

<main class="simple-wrap">
    <?php if(session('status') || session('success')): ?>
        <div class="simple-alert"><?php echo e(session('status') ?? session('success')); ?></div>
    <?php endif; ?>
    <?php if($errors->any()): ?>
        <div class="simple-errors">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>
    <?php echo $__env->yieldContent('content'); ?>
</main>
</body>
</html>
<?php /**PATH C:\Program Files\Ampps\www\car_service\resources\views/layouts/client.blade.php ENDPATH**/ ?>