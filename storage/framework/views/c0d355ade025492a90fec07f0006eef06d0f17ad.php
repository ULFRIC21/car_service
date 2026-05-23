<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title', 'Тех Эксперт'); ?> — автосервис</title>
    <link href="<?php echo e(asset('css/landing.css')); ?>" rel="stylesheet">
</head>
<body class="landing-page">

    <header class="landing-header">
        <div class="landing-container landing-header__inner">
            <a href="<?php echo e(url('/')); ?>" class="landing-logo">
                <span class="landing-logo__icon" aria-hidden="true"></span>
                <span>Тех Эксперт</span>
            </a>
            <a href="tel:8800535353" class="landing-header__phone">8 800 535 353</a>
            <div class="landing-header__actions">
                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(route('home')); ?>" class="landing-btn-register">Личный кабинет</a>
                <?php else: ?>
                    <?php if(Route::has('register')): ?>
                        <a href="<?php echo e(route('register')); ?>" class="landing-btn-register">Регистрация</a>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="landing-btn-register">Войти</a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <?php echo $__env->yieldContent('hero'); ?>

    <nav class="landing-subnav" aria-label="Основное меню">
        <div class="landing-container landing-subnav__inner">
            <a href="<?php echo e(route('pages.corporate')); ?>" class="landing-subnav__link <?php echo e(request()->routeIs('pages.corporate') ? 'is-active' : ''); ?>">Корпоративным сотрудникам</a>
            <a href="<?php echo e(route('pages.reviews')); ?>" class="landing-subnav__link <?php echo e(request()->routeIs('pages.reviews') ? 'is-active' : ''); ?>">Отзывы</a>
            <a href="<?php echo e(route('pages.contacts')); ?>" class="landing-subnav__link <?php echo e(request()->routeIs('pages.contacts') ? 'is-active' : ''); ?>">Контакты</a>
        </div>
    </nav>

    <main><?php echo $__env->yieldContent('content'); ?></main>

</body>
</html>
<?php /**PATH C:\Program Files\Ampps\www\car_service\resources\views/layouts/landing.blade.php ENDPATH**/ ?>