<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', config('app.name', 'АвтоМастер')); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
<div id="app">
    <div class="as-topbar d-none d-md-block">
        <div class="container d-flex justify-content-between align-items-center">
            <span><i class="bi bi-clock me-1"></i> Пн–Сб 9:00–20:00</span>
            <span><i class="bi bi-geo-alt me-1"></i> Москва, ул. Сервисная, 12</span>
            <a href="tel:+74951234567"><i class="bi bi-telephone me-1"></i> +7 (495) 123-45-67</a>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg as-navbar sticky-top">
        <div class="container">
            <a class="navbar-brand" href="<?php echo e(url('/')); ?>"><i class="bi bi-wrench-adjustable-circle"></i> Авто<span>Мастер</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Меню">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(url('/#services')); ?>">Услуги</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(url('/#gallery')); ?>">Мастерская</a>
                    </li>
                    <?php if(auth()->guard()->check()): ?>
                        <?php if (! (auth()->user()->isAdmin())): ?>
                            <li class="nav-item"><a class="nav-link <?php echo e(request()->routeIs('home') ? 'active' : ''); ?>" href="<?php echo e(route('home')); ?>">Кабинет</a></li>
                            <li class="nav-item"><a class="nav-link <?php echo e(request()->routeIs('appointments.*') ? 'active' : ''); ?>" href="<?php echo e(route('appointments.index')); ?>">Мои записи</a></li>
                        <?php endif; ?>
                        <?php if(auth()->user()->isAdmin()): ?>
                            <li class="nav-item"><a class="nav-link <?php echo e(request()->routeIs('admin.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.dashboard')); ?>">Админ-панель</a></li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
                <ul class="navbar-nav align-items-lg-center gap-lg-2">
                    <li class="nav-item d-none d-lg-block">
                        <a class="as-btn-phone" href="tel:+74951234567"><i class="bi bi-telephone-fill text-warning"></i> +7 (495) 123-45-67</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn as-btn-cta btn-sm" href="tel:+74951234567"><i class="bi bi-telephone-outbound me-1"></i>Звонок</a>
                    </li>
                    <?php if(auth()->guard()->guest()): ?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('login')); ?>">Вход</a></li>
                        <li class="nav-item"><a class="btn as-btn-outline btn-sm" href="<?php echo e(route('register')); ?>">Регистрация</a></li>
                    <?php else: ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle me-1"></i><?php echo e(Auth::user()->full_name); ?>

                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <?php if (! (auth()->user()->isAdmin())): ?>
                                    <li><a class="dropdown-item" href="<?php echo e(route('home')); ?>"><i class="bi bi-grid me-2"></i>Личный кабинет</a></li>
                                    <li><a class="dropdown-item" href="<?php echo e(route('appointments.create')); ?>"><i class="bi bi-calendar-plus me-2"></i>Записаться</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                <?php endif; ?>
                                <?php if(auth()->user()->isAdmin()): ?>
                                    <li><a class="dropdown-item" href="<?php echo e(route('admin.dashboard')); ?>"><i class="bi bi-shield-lock me-2"></i>Админ-панель</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                <?php endif; ?>
                                <li>
                                    <a class="dropdown-item text-danger" href="<?php echo e(route('logout')); ?>"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right me-2"></i>Выйти
                                    </a>
                                </li>
                            </ul>
                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none"><?php echo csrf_field(); ?></form>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <?php echo $__env->make('partials.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <main class="as-main <?php echo $__env->yieldContent('main_class'); ?>">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <?php echo $__env->make('partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Program Files\Ampps\www\car_service\resources\views/layouts/app.blade.php ENDPATH**/ ?>