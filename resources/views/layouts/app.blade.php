<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'АвтоМастер'))</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('styles')
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
            <a class="navbar-brand" href="{{ url('/') }}">Авто<span>Мастер</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Меню">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('public.services') ? 'active' : '' }}" href="{{ route('public.services') }}">Услуги</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('public.promotions') ? 'active' : '' }}" href="{{ route('public.promotions') }}">Акции</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('public.reviews') ? 'active' : '' }}" href="{{ route('public.reviews') }}">Отзывы</a>
                    </li>
                    @auth
                        @unless(auth()->user()->isAdmin())
                            <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Кабинет</a></li>
                            <li class="nav-item"><a class="nav-link {{ request()->routeIs('appointments.*') ? 'active' : '' }}" href="{{ route('appointments.index') }}">Мои записи</a></li>
                        @endunless
                        @if(auth()->user()->isAdmin())
                            <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.*') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Админ-панель</a></li>
                        @endif
                    @endauth
                </ul>
                <ul class="navbar-nav align-items-lg-center gap-lg-2">
                    <li class="nav-item d-none d-lg-block">
                        <a class="as-btn-phone" href="tel:+74951234567"><i class="bi bi-telephone-fill text-warning"></i> +7 (495) 123-45-67</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn as-btn-cta btn-sm" href="{{ route('callback.create') }}"><i class="bi bi-telephone-outbound me-1"></i>Звонок</a>
                    </li>
                    @guest
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Вход</a></li>
                        <li class="nav-item"><a class="btn as-btn-outline btn-sm" href="{{ route('register') }}">Регистрация</a></li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                @unless(auth()->user()->isAdmin())
                                    <li><a class="dropdown-item" href="{{ route('home') }}"><i class="bi bi-grid me-2"></i>Личный кабинет</a></li>
                                    <li><a class="dropdown-item" href="{{ route('vehicles.index') }}"><i class="bi bi-car-front me-2"></i>Мои авто</a></li>
                                    <li><a class="dropdown-item" href="{{ route('appointments.create') }}"><i class="bi bi-calendar-plus me-2"></i>Записаться</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                @endunless
                                @if(auth()->user()->isAdmin())
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="bi bi-shield-lock me-2"></i>Админ-панель</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                @endif
                                <li>
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right me-2"></i>Выйти
                                    </a>
                                </li>
                            </ul>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    @include('partials.flash')

    <main class="as-main @yield('main_class')">
        @if(request()->routeIs('admin.*'))
            <div class="container-fluid px-lg-4">
                <div class="as-admin-layout">
                    @include('partials.admin-sidebar')
                    <div class="as-admin-content">
                        @yield('content')
                    </div>
                </div>
            </div>
        @else
            @yield('content')
        @endif
    </main>

    @unless(request()->routeIs('admin.*'))
        @include('partials.footer')
    @endunless
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
