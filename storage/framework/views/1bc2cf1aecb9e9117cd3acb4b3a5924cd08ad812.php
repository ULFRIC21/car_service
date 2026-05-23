<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title', 'Админка'); ?> — Тех Эксперт</title>
    <link href="<?php echo e(asset('css/admin-simple.css')); ?>" rel="stylesheet">
</head>
<body class="admin-page">
<header class="admin-top">
    <h1>Админка</h1>
    <div class="admin-top__actions">
        <a href="<?php echo e(url('/')); ?>">На сайт</a>
        <a href="<?php echo e(route('logout')); ?>"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a>
        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none"><?php echo csrf_field(); ?></form>
    </div>
</header>

<main class="admin-wrap">
    <?php if(session('success')): ?>
        <div class="admin-alert"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <?php echo $__env->yieldContent('content'); ?>
</main>
</body>
</html>
<?php /**PATH C:\Program Files\Ampps\www\car_service\resources\views/layouts/admin.blade.php ENDPATH**/ ?>