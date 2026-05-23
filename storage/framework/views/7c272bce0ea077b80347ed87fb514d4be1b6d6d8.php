

<?php $__env->startSection('title', 'Главная'); ?>

<?php $__env->startSection('hero'); ?>
<section class="landing-hero" style="background-image: linear-gradient(rgba(0,0,0,0.42), rgba(0,0,0,0.52)), url('<?php echo e(asset('images/glav/slide1.jpg')); ?>');">
    <div class="landing-hero__inner">
        <h1 class="landing-hero__phone">
            <a href="tel:8800535353">8 800 535 353</a>
        </h1>
        <p class="landing-hero__tagline">Проще позвонить, чем фильтр поменять</p>
        <a href="tel:8800535353" class="landing-hero__cta">Позвонить</a>
        <p class="landing-hero__disclaimer">
            Отдельно оплачивается стоимость фильтра, стоимость технической мойки и стоимость снятия защиты двигателя.
        </p>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php
    $bannerUrl = function (string $key) {
        $file = config("site_home.banners.{$key}");
        if (! $file || ! is_file(public_path('images/st__gkav/' . $file))) {
            return null;
        }
        return asset('images/st__gkav/' . $file);
    };
?>

<section class="landing-section landing-section--light">
    <div class="landing-container">
        <h2 class="landing-section__title">Оказываем услуги по ремонту автомобилей</h2>
        <div class="services-grid">
            <?php $__currentLoopData = config('site_services.categories'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('services.show', $category['slug'])); ?>" class="service-card">
                    <h3 class="service-card__title"><?php echo e($category['title']); ?></h3>
                    <ul class="service-card__list">
                        <?php $__currentLoopData = $category['card_items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($item); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <img
                        src="<?php echo e(asset($category['card_image'])); ?>"
                        alt="<?php echo e($category['title']); ?>"
                        class="service-card__img"
                    >
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<div class="home-strips">
    <section class="home-strip home-strip--jobs">
        <div class="landing-container home-strip__grid">
            <div class="home-strip__panel home-strip__panel--gray">
                <h2 class="home-strip__heading">Требуются работники</h2>
                <p class="home-strip__sub">зп от 50 т</p>
                <a href="<?php echo e(route('pages.contacts')); ?>" class="home-strip__btn">откликнуться</a>
            </div>
            <div class="home-strip__panel home-strip__panel--photo">
                <?php if($url = $bannerUrl('jobs')): ?>
                    <img src="<?php echo e($url); ?>" alt="Требуются работники" class="home-strip__photo">
                <?php endif; ?>
                <p class="home-strip__phone-badge"><a href="tel:8800535353">8 800 535 353</a></p>
            </div>
        </div>
    </section>

    <section class="home-strip home-strip--tires">
        <div class="landing-container home-strip__grid">
            <div class="home-strip__panel home-strip__panel--dark">
                <h2 class="home-strip__heading">Пора менять резину!</h2>
                <p class="home-strip__text">
                    Новое оборудование! Доступные цены! Записывайтесь к нам шиномонтаж.
                    Для вас: мойка колёс, перебортовка, балансировка.
                </p>
                <p class="home-strip__phone-badge home-strip__phone-badge--inline">
                    <a href="tel:8800535353">8 800 535 353</a>
                </p>
            </div>
            <div class="home-strip__panel home-strip__panel--photo home-strip__panel--photo-dark">
                <?php if($url = $bannerUrl('tires')): ?>
                    <img src="<?php echo e($url); ?>" alt="Шиномонтаж" class="home-strip__photo">
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="home-strip home-strip--team">
        <div class="landing-container home-strip__grid">
            <div class="home-strip__panel home-strip__panel--photo">
                <?php if($url = $bannerUrl('team')): ?>
                    <img src="<?php echo e($url); ?>" alt="Команда Тех Эксперт" class="home-strip__photo home-strip__photo--left">
                <?php endif; ?>
            </div>
            <div class="home-strip__panel home-strip__panel--gray home-strip__panel--team-text">
                <p>команда тех эксперт работает с вами</p>
            </div>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.landing', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Program Files\Ampps\www\car_service\resources\views/welcome.blade.php ENDPATH**/ ?>