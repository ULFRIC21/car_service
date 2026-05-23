<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Тех Эксперт'); ?> — автосервис</title>
    <link href="<?php echo e(asset('css/landing.css')); ?>" rel="stylesheet">
</head>
<body class="landing-page landing-page--auth">

    <header class="landing-header">
        <div class="landing-container landing-header__inner">
            <a href="<?php echo e(url('/')); ?>" class="landing-logo">
                <span class="landing-logo__icon" aria-hidden="true"></span>
                <span>Тех Эксперт</span>
            </a>
            <a href="tel:8800535353" class="landing-header__phone">8 800 535 353</a>
            <div class="landing-header__actions">
                <?php if(auth()->guard()->check()): ?>
                    <?php if(auth()->user()->isAdmin()): ?>
                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="landing-btn-register">Админка</a>
                    <?php endif; ?>
                    <a href="<?php echo e(url('/')); ?>" class="landing-btn-register">На главную</a>
                <?php else: ?>
                    <?php if(request()->routeIs('login')): ?>
                        <a href="<?php echo e(route('register')); ?>" class="landing-btn-register">Регистрация</a>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="landing-btn-register">Войти</a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <main class="auth-main">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

</body>
</html>
<?php /**PATH C:\Program Files\Ampps\www\car_service\resources\views/layouts/landing-auth.blade.php ENDPATH**/ ?>