@extends('layouts.app')

@section('title', 'АвтоМастер — автосервис в Москве')
@section('main_class', 'as-main--flush')

@section('content')
<section class="as-hero">
    <div class="container position-relative">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <div class="as-hero-badge"><i class="bi bi-shield-check"></i> Гарантия на все работы</div>
                <h1 class="mb-3">Ремонт и обслуживание автомобиля без очередей</h1>
                <p class="lead mb-4">Диагностика, ТО, ходовая и тормоза. Запишитесь онлайн за 2 минуты — мастер подтвердит время в тот же день.</p>
                <div class="d-flex flex-wrap gap-2 mb-4">
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-lg as-btn-cta">Панель администратора</a>
                        @else
                            <a href="{{ route('appointments.create') }}" class="btn btn-lg as-btn-cta"><i class="bi bi-calendar-plus me-2"></i>Записаться в сервис</a>
                            <a href="{{ route('home') }}" class="btn btn-lg as-btn-outline text-white border-white">Личный кабинет</a>
                        @endif
                    @else
                        <a href="{{ route('register') }}" class="btn btn-lg as-btn-cta"><i class="bi bi-calendar-plus me-2"></i>Записаться онлайн</a>
                        <a href="{{ route('callback.create') }}" class="btn btn-lg as-btn-outline text-white border-white">Заказать звонок</a>
                    @endauth
                </div>
            </div>
            <div class="col-lg-5">
                    <div class="row g-3">
                    <div class="col-4">
                        <div class="as-stat-pill">
                            <strong>12+</strong>
                            <span class="small text-secondary d-block">лет на рынке</span>
                        </div>
                    </div>
                    <div class="col-4"><div class="as-stat-pill"><strong>8K+</strong><span class="small text-secondary">клиентов</span></div></div>
                    <div class="col-4"><div class="as-stat-pill"><strong>4.9</strong><span class="small text-secondary">рейтинг</span></div></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="as-section bg-white">
    <div class="container">
        <h2 class="as-section-title">Популярные услуги</h2>
        <p class="as-section-sub">Прозрачные цены, как на сайтах ведущих сетей автосервисов</p>
        <div class="row g-3">
            @forelse($services as $service)
                <div class="col-md-6 col-lg-4">
                    <div class="as-card as-service-card">
                        <div class="card-body">
                            <div class="as-card-icon"><i class="bi bi-tools"></i></div>
                            <h5 class="fw-bold mb-2">{{ $service->name }}</h5>
                            <p class="text-muted small mb-3">{{ Str::limit($service->description, 80) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="as-price">{{ number_format($service->price, 0, ',', ' ') }} ₽</span>
                                <span class="text-muted small"><i class="bi bi-clock"></i> {{ $service->duration_minutes }} мин</span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12"><p class="text-muted">Услуги скоро появятся.</p></div>
            @endforelse
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('public.services') }}" class="btn as-btn-outline">Все услуги и цены</a>
        </div>
    </div>
</section>

@if($promotions->isNotEmpty())
<section class="as-section">
    <div class="container">
        <h2 class="as-section-title">Акции</h2>
        <div class="row g-3">
            @foreach($promotions as $promo)
                <div class="col-md-6">
                    <div class="as-promo">
                        <h5 class="fw-bold mb-2">{{ $promo->title }}</h5>
                        <p class="mb-3 opacity-90">{{ $promo->body }}</p>
                        <a href="{{ route('public.promotions') }}" class="btn btn-light btn-sm">Подробнее</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="as-section bg-white">
    <div class="container">
        <h2 class="as-section-title text-center">Почему выбирают нас</h2>
        <div class="row g-4 mt-2">
            <div class="col-md-4 text-center">
                <div class="as-card-icon mx-auto"><i class="bi bi-calendar2-check"></i></div>
                <h5 class="fw-bold">Онлайн-запись</h5>
                <p class="text-muted small">Выберите услугу и удобное время без звонков в колл-центр</p>
            </div>
            <div class="col-md-4 text-center">
                <div class="as-card-icon mx-auto"><i class="bi bi-file-earmark-text"></i></div>
                <h5 class="fw-bold">Заказ-наряды онлайн</h5>
                <p class="text-muted small">Статус ремонта и состав работ в личном кабинете</p>
            </div>
            <div class="col-md-4 text-center">
                <div class="as-card-icon mx-auto"><i class="bi bi-award"></i></div>
                <h5 class="fw-bold">Опытные мастера</h5>
                <p class="text-muted small">Сертифицированное оборудование и оригинальные запчасти</p>
            </div>
        </div>
    </div>
</section>

@if($reviews->isNotEmpty())
<section class="as-section">
    <div class="container">
        <h2 class="as-section-title">Отзывы клиентов</h2>
        <div class="row g-3">
            @foreach($reviews as $review)
                <div class="col-md-4">
                    <div class="as-card p-4">
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
            <a href="{{ route('public.reviews') }}" class="btn as-btn-outline">Все отзывы</a>
        </div>
    </div>
</section>
@endif

<section class="as-section bg-dark text-white text-center">
    <div class="container py-2">
        <h2 class="fw-bold mb-3">Готовы записаться?</h2>
        <p class="text-secondary mb-4">Зарегистрируйтесь и управляйте автомобилями, записями и заказ-нарядами в одном месте</p>
        @guest
            <a href="{{ route('register') }}" class="btn btn-lg as-btn-cta me-2">Создать аккаунт</a>
            <a href="{{ route('login') }}" class="btn btn-lg btn-outline-light">Войти</a>
        @else
            <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('appointments.create') }}" class="btn btn-lg as-btn-cta">
                {{ auth()->user()->isAdmin() ? 'В админ-панель' : 'Записаться сейчас' }}
            </a>
        @endguest
    </div>
</section>
@endsection
