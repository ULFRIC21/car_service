@extends('layouts.app')

@section('title', 'АвтоМастер — автосервис в Москве')
@section('main_class', 'as-main--flush')

@php
    $fallbackServiceImgs = config('site.service_files', []);
@endphp

@section('content')
<section class="as-hero">
    <div class="as-hero-bg" style="background-image: url('{{ $imgs['hero'] }}')"></div>
    <div class="as-hero-overlay"></div>
    <div class="container position-relative">
        <div class="row align-items-center g-4 g-lg-5">
            <div class="col-lg-7">
                <div class="as-hero-badge"><i class="bi bi-shield-check"></i> Гарантия на все работы до 12 месяцев</div>
                <h1 class="mb-3">Профессиональный автосервис — ремонт, ТО и диагностика</h1>
                <p class="lead mb-4">Современное оборудование, опытные мастера и прозрачные цены. Запишитесь онлайн за пару минут — подтвердим время в день обращения.</p>
                <div class="d-flex flex-wrap gap-2 mb-0">
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-lg as-btn-cta">Панель администратора</a>
                        @else
                            <a href="{{ route('appointments.create') }}" class="btn btn-lg as-btn-cta"><i class="bi bi-calendar-plus me-2"></i>Записаться в сервис</a>
                            <a href="{{ route('home') }}" class="btn btn-lg btn-outline-light">Личный кабинет</a>
                        @endif
                    @else
                        <a href="{{ route('register') }}" class="btn btn-lg as-btn-cta"><i class="bi bi-calendar-plus me-2"></i>Записаться онлайн</a>
                        <a href="tel:+74951234567" class="btn btn-lg btn-outline-light">Заказать звонок</a>
                    @endauth
                </div>
                <div class="as-hero-features">
                    <span><i class="bi bi-check-circle-fill"></i> Диагностика от 30 мин</span>
                    <span><i class="bi bi-check-circle-fill"></i> Оригинальные запчасти</span>
                    <span><i class="bi bi-check-circle-fill"></i> Заказ-наряд онлайн</span>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block">
                <div class="as-hero-collage">
                    <div class="as-hero-collage-sm as-hero-collage-sm--tl">
                        <img src="{{ $imgs['engine'] }}" alt="Ремонт двигателя" loading="lazy">
                    </div>
                    <div class="as-hero-collage-main">
                        <img src="{{ $imgs['mechanic'] }}" alt="Мастер в автосервисе" loading="lazy">
                    </div>
                    <div class="as-hero-collage-sm as-hero-collage-sm--br">
                        <img src="{{ $imgs['brakes'] }}" alt="Тормозная система" loading="lazy">
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-3 mt-4 mt-lg-5">
            <div class="col-4 col-md-4">
                <div class="as-stat-pill">
                    <strong>12+</strong>
                    <span class="small text-secondary d-block">лет на рынке</span>
                </div>
            </div>
            <div class="col-4 col-md-4">
                <div class="as-stat-pill">
                    <strong>8K+</strong>
                    <span class="small text-secondary d-block">довольных клиентов</span>
                </div>
            </div>
            <div class="col-4 col-md-4">
                <div class="as-stat-pill">
                    <strong>4.9</strong>
                    <span class="small text-secondary d-block">средний рейтинг</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="as-trust-strip">
    <div class="container">
        <div class="row g-3">
            <div class="col-6 col-lg-3">
                <div class="as-trust-item">
                    <div class="icon"><i class="bi bi-cpu"></i></div>
                    <div>
                        <strong>Компьютерная диагностика</strong>
                        <span>Оборудование дилерского уровня</span>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="as-trust-item">
                    <div class="icon"><i class="bi bi-gear-wide-connected"></i></div>
                    <div>
                        <strong>Ходовая и двигатель</strong>
                        <span>Ремонт любой сложности</span>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="as-trust-item">
                    <div class="icon"><i class="bi bi-droplet"></i></div>
                    <div>
                        <strong>ТО и жидкости</strong>
                        <span>Масло, фильтры, тормоза</span>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="as-trust-item">
                    <div class="icon"><i class="bi bi-clock-history"></i></div>
                    <div>
                        <strong>Без очередей</strong>
                        <span>Запись на точное время</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="services" class="as-section as-section--alt">
    <div class="container">
        <div class="text-center mb-4 mb-lg-5">
            <h2 class="as-section-title">Популярные услуги</h2>
            <p class="as-section-sub mb-0 mx-auto" style="max-width: 32rem">Прозрачные цены и сроки — как на сайтах крупных сетей автосервисов</p>
        </div>
        <div class="row g-4">
            @forelse($services as $index => $service)
                @php
                    $img = $service->image_url
                        ?? site_image($fallbackServiceImgs[$index % max(1, count($fallbackServiceImgs))] ?? '');
                @endphp
                <div class="col-md-6 col-lg-4">
                    <article class="as-card as-service-card">
                        <div class="as-card-img">
                            @if($img)
                            <img src="{{ $img }}" alt="{{ $service->name }}" loading="lazy">
                            @endif
                            @if($index === 0)
                                <span class="as-card-img-badge">Хит</span>
                            @endif
                        </div>
                        <div class="card-body">
                            <h5 class="fw-bold mb-2">{{ $service->name }}</h5>
                            <p class="text-muted small mb-3">{{ Str::limit($service->description, 90) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="as-price">от {{ number_format($service->price, 0, ',', ' ') }} ₽</span>
                                <span class="text-muted small"><i class="bi bi-clock"></i> {{ $service->duration_minutes }} мин</span>
                            </div>
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12"><p class="text-muted text-center">Услуги скоро появятся.</p></div>
            @endforelse
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('register') }}" class="btn as-btn-cta px-4">Записаться на услугу</a>
        </div>
    </div>
</section>

<section class="as-section">
    <div class="container">
        <div class="as-feature-split">
            <div class="as-feature-split-img">
                <img src="{{ $imgs['workshop'] }}" alt="Бокс автосервиса АвтоМастер" loading="lazy">
            </div>
            <div>
                <h2 class="as-section-title">Современная мастерская в Москве</h2>
                <p class="text-muted">Подъёмники, стенды, диагностические сканеры — всё для быстрого и точного ремонта. Работаем с легковыми авто всех марок.</p>
                <ul class="as-check-list">
                    <li><i class="bi bi-check-circle-fill"></i> Сертифицированные мастера с опытом от 5 лет</li>
                    <li><i class="bi bi-check-circle-fill"></i> Фотоотчёт и согласование допработ</li>
                    <li><i class="bi bi-check-circle-fill"></i> Уютная зона ожидания и Wi‑Fi</li>
                    <li><i class="bi bi-check-circle-fill"></i> Онлайн-запись и статус ремонта в кабинете</li>
                </ul>
                <a href="tel:+74951234567" class="btn as-btn-outline mt-2">Получить консультацию</a>
            </div>
        </div>
    </div>
</section>

<section class="as-section as-section--alt">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="as-section-title">Как записаться</h2>
            <p class="as-section-sub mb-0">Четыре простых шага — без звонков в колл-центр</p>
        </div>
        <div class="row as-steps g-3">
            <div class="col-6 col-lg-3">
                <div class="as-step">
                    <div class="as-step-num">1</div>
                    <h5>Регистрация</h5>
                    <p>Создайте аккаунт за минуту</p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="as-step">
                    <div class="as-step-num">2</div>
                    <h5>Выбор услуги</h5>
                    <p>Укажите авто и вид работ</p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="as-step">
                    <div class="as-step-num">3</div>
                    <h5>Дата и время</h5>
                    <p>Удобный слот в календаре</p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="as-step">
                    <div class="as-step-num">4</div>
                    <h5>Приезд в сервис</h5>
                    <p>Мастер ждёт в назначенное время</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="gallery" class="as-section">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-end gap-2 mb-4">
            <div>
                <h2 class="as-section-title mb-1">Наша мастерская</h2>
                <p class="as-section-sub mb-0">Реальные условия работы — двигатели, инструмент, боксы</p>
            </div>
        </div>
        <div class="as-gallery">
            @foreach($galleryItems as $i => $item)
                <figure class="as-gallery-item {{ $i === 0 ? 'as-gallery-item--wide' : '' }}">
                    <img src="{{ $item['src'] }}" alt="{{ $item['alt'] }}" loading="lazy">
                    <figcaption>{{ $item['alt'] }}</figcaption>
                </figure>
            @endforeach
        </div>
    </div>
</section>

@if($promotions->isNotEmpty())
<section class="as-section as-section--alt">
    <div class="container">
        <h2 class="as-section-title text-center">Акции и скидки</h2>
        <p class="as-section-sub text-center">Выгоднее при записи через сайт</p>
        <div class="row g-4">
            @foreach($promotions as $promo)
                <div class="col-md-6">
                    <div class="as-promo as-promo-with-img h-100">
                        <div class="as-promo-img d-none d-md-block">
                            <img src="{{ $imgs['car'] }}" alt="Автомобиль после обслуживания" loading="lazy">
                        </div>
                        <div>
                            <h5 class="fw-bold mb-2">{{ $promo->title }}</h5>
                            <p class="mb-3 opacity-90">{{ $promo->body }}</p>
                            <a href="{{ route('register') }}" class="btn btn-light btn-sm fw-semibold">Записаться</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="as-section as-section--alt">
    <div class="container">
        <h2 class="as-section-title text-center">Почему выбирают АвтоМастер</h2>
        <div class="row g-4 mt-2">
            <div class="col-md-4">
                <div class="as-card p-4 text-center h-100">
                    <div class="as-card-icon mx-auto"><i class="bi bi-calendar2-check"></i></div>
                    <h5 class="fw-bold">Онлайн-запись 24/7</h5>
                    <p class="text-muted small mb-0">Выберите услугу и время — мастер подтвердит запись</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="as-card p-4 text-center h-100">
                    <div class="as-card-icon mx-auto"><i class="bi bi-file-earmark-text"></i></div>
                    <h5 class="fw-bold">Заказ-наряды онлайн</h5>
                    <p class="text-muted small mb-0">Состав работ, запчасти и статус ремонта в личном кабинете</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="as-card p-4 text-center h-100">
                    <div class="as-card-icon mx-auto"><i class="bi bi-award"></i></div>
                    <h5 class="fw-bold">Гарантия на работы</h5>
                    <p class="text-muted small mb-0">Официальная гарантия и проверенные поставщики запчастей</p>
                </div>
            </div>
        </div>
    </div>
</section>

@if($reviews->isNotEmpty())
<section class="as-section">
    <div class="container">
        <h2 class="as-section-title">Отзывы клиентов</h2>
        <p class="as-section-sub">Реальные оценки после обслуживания</p>
        <div class="row g-4">
            @foreach($reviews as $review)
                <div class="col-md-4">
                    <div class="as-card p-4 h-100">
                        <div class="as-stars mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }}"></i>
                            @endfor
                        </div>
                        <p class="mb-2">«{{ Str::limit($review->body, 120) }}»</p>
                        <p class="text-muted small mb-0">— {{ $review->user->name ?? 'Клиент' }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('register') }}" class="btn as-btn-outline">Оставить отзыв</a>
        </div>
    </div>
</section>
@endif

<section class="as-cta-band">
    <div class="as-cta-band-bg" style="background-image: url('{{ $imgs['hero'] }}')"></div>
    <div class="as-cta-band-overlay"></div>
    <div class="container py-2">
        <h2 class="fw-bold mb-3 display-6">Готовы записаться на сервис?</h2>
        <p class="text-secondary mb-4 mx-auto" style="max-width: 28rem">Управляйте автомобилями, записями и заказ-нарядами в одном личном кабинете</p>
        @guest
            <a href="{{ route('register') }}" class="btn btn-lg as-btn-cta me-2 mb-2">Создать аккаунт</a>
            <a href="{{ route('login') }}" class="btn btn-lg btn-outline-light mb-2">Войти</a>
        @else
            <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('appointments.create') }}" class="btn btn-lg as-btn-cta">
                {{ auth()->user()->isAdmin() ? 'В админ-панель' : 'Записаться сейчас' }}
            </a>
        @endguest
    </div>
</section>
@endsection
