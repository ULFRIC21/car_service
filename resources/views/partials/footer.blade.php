<footer class="as-footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="as-footer-brand-icon"><i class="bi bi-wrench-adjustable-circle"></i></div>
                <h6>Авто<span class="text-warning">Мастер</span></h6>
                <p class="small mb-0 pe-lg-3">Полный спектр услуг по ремонту и обслуживанию автомобилей. Современная мастерская, гарантия на работы.</p>
            </div>
            <div class="col-md-4">
                <h6>Клиентам</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="{{ route('public.services') }}">Услуги и цены</a></li>
                    <li class="mb-2"><a href="{{ route('public.promotions') }}">Акции</a></li>
                    <li class="mb-2"><a href="{{ route('public.reviews') }}">Отзывы</a></li>
                    <li class="mb-2"><a href="{{ route('callback.create') }}">Заказать звонок</a></li>
                    @auth
                        <li class="mb-2"><a href="{{ route('appointments.create') }}">Записаться онлайн</a></li>
                    @else
                        <li class="mb-2"><a href="{{ route('register') }}">Регистрация</a></li>
                    @endauth
                </ul>
            </div>
            <div class="col-md-4">
                <h6>Контакты</h6>
                <p class="small mb-1"><i class="bi bi-telephone me-2 text-warning"></i><a href="tel:+74951234567">+7 (495) 123-45-67</a></p>
                <p class="small mb-1"><i class="bi bi-geo-alt me-2"></i>Москва, ул. Сервисная, 12</p>
                <p class="small mb-0"><i class="bi bi-clock me-2"></i>Пн–Сб 9:00–20:00</p>
            </div>
        </div>
        <hr class="border-secondary my-4 opacity-25">
        <p class="small text-center mb-0 opacity-75">&copy; {{ date('Y') }} {{ config('app.name', 'АвтоМастер') }}. Все права защищены.</p>
    </div>
</footer>
