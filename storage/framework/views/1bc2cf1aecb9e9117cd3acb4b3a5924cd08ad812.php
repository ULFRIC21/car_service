<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title', 'Админка'); ?> — Тех Эксперт</title>
    <link href="<?php echo e(asset('css/simple.css')); ?>" rel="stylesheet">
    <style>
        body.simple-page { background: #f4f4f4; }
        .simple-top { border-bottom: 1px solid #ddd; }
        .simple-brand { color: #000 !important; }
    </style>
</head>
<body class="simple-page">
<header class="simple-top">
    <div class="simple-top__row">
        <span class="simple-brand">Админка</span>
        <div>
            <a href="<?php echo e(url('/')); ?>">На сайт</a>
            &nbsp;|&nbsp;
            <a href="<?php echo e(route('logout')); ?>"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a>
            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display:none"><?php echo csrf_field(); ?></form>
        </div>
    </div>
</header>

<main class="simple-wrap">
    <?php if(session('success')): ?>
        <div class="simple-alert"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <?php echo $__env->yieldContent('content'); ?>
</main>
</body>
</html>
<?php /**PATH C:\Program Files\Ampps\www\car_service\resources\views/layouts/admin.blade.php ENDPATH**/ ?>