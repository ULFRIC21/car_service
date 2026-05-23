

<?php $__env->startSection('title', 'Контакты'); ?>

<?php $__env->startSection('content'); ?>
<section class="landing-section landing-section--light">
    <div class="landing-container page-content">
        <h1 class="page-content__title">Контакты</h1>
        <dl class="contacts-list">
            <dt>Телефон</dt>
            <dd><a href="tel:8800535353">8 800 535 353</a></dd>
            <dt>Режим работы</dt>
            <dd>Пн–Сб: 9:00–20:00, Вс: 10:00–18:00</dd>
            <dt>Адрес</dt>
            <dd>426008, республика Удмуртия, г. Ижевск, Пушкинская ул., 268/1</dd>
            <dt>E-mail</dt>
            <dd><a href="mailto:info@teh-expert.local">info@teh-expert.local</a></dd>
        </dl>

        <div class="contacts-map">
            <h2 class="contacts-map__title">Как нас найти</h2>
            <p class="contacts-map__caption">Пушкинская ул., 268/1, Ижевск</p>
            <div class="contacts-map__frame">
                <iframe
                    src="https://yandex.ru/map-widget/v1/?ll=53.210278%2C56.851944&amp;z=17&amp;l=map&amp;pt=53.210278%2C56.851944%2Cpm2rdm&amp;text=%D0%A2%D0%B5%D1%85%20%D0%AD%D0%BA%D1%81%D0%BF%D0%B5%D1%80%D1%82"
                    title="Карта: Пушкинская ул., 268/1, Ижевск"
                    allowfullscreen
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                ></iframe>
            </div>
            <p class="contacts-map__link">
                <a href="https://yandex.ru/maps/?text=%D0%9F%D1%83%D1%88%D0%BA%D0%B8%D0%BD%D1%81%D0%BA%D0%B0%D1%8F%20%D1%83%D0%BB.%2C%20268%2F1%2C%20%D0%98%D0%B6%D0%B5%D0%B2%D1%81%D0%BA%2C%20426008" target="_blank" rel="noopener noreferrer">Открыть в Яндекс.Картах</a>
            </p>
        </div>

        <p><a href="<?php echo e(route('register')); ?>" class="landing-btn-dark">Записаться онлайн</a></p>
        <p><a href="<?php echo e(url('/')); ?>" class="landing-link-back">← На главную</a></p>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.landing', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Program Files\Ampps\www\car_service\resources\views/pages/contacts.blade.php ENDPATH**/ ?>