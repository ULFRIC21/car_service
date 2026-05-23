<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Тех Эксперт') — автосервис</title>
    <link href="{{ asset('css/landing.css') }}" rel="stylesheet">
</head>
<body class="landing-page">

    <header class="landing-header">
        <div class="landing-container landing-header__inner">
            <a href="{{ url('/') }}" class="landing-logo">
                <span class="landing-logo__icon" aria-hidden="true"></span>
                <span>Тех Эксперт</span>
            </a>
            <a href="tel:8800535353" class="landing-header__phone">8 800 535 353</a>
            <div class="landing-header__actions">
                @auth
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="landing-btn-register">Админка</a>
                    @endif
                    <a href="{{ route('logout') }}" class="landing-header__logout"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">@csrf</form>
                @else
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="landing-btn-register">Регистрация</a>
                    @else
                        <a href="{{ route('login') }}" class="landing-btn-register">Войти</a>
                    @endif
                @endauth
            </div>
        </div>
    </header>

    @yield('hero')

    <nav class="landing-subnav" aria-label="Основное меню">
        <div class="landing-container landing-subnav__inner">
            <a href="{{ route('pages.corporate') }}" class="landing-subnav__link {{ request()->routeIs('pages.corporate') ? 'is-active' : '' }}">Корпоративным сотрудникам</a>
            <a href="{{ route('pages.reviews') }}" class="landing-subnav__link {{ request()->routeIs('pages.reviews') ? 'is-active' : '' }}">Отзывы</a>
            <a href="{{ route('pages.contacts') }}" class="landing-subnav__link {{ request()->routeIs('pages.contacts') ? 'is-active' : '' }}">Контакты</a>
        </div>
    </nav>

    <main>
        @if (session('success'))
            <div class="landing-container">
                <p class="landing-notice">{{ session('success') }}</p>
            </div>
        @endif
        @yield('content')
    </main>

</body>
</html>
