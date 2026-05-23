<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Тех Эксперт') — автосервис</title>
    <link href="{{ asset('css/landing.css') }}" rel="stylesheet">
</head>
<body class="landing-page landing-page--auth">

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
                    <a href="{{ url('/') }}" class="landing-btn-register">На главную</a>
                @else
                    @if (request()->routeIs('login'))
                        <a href="{{ route('register') }}" class="landing-btn-register">Регистрация</a>
                    @else
                        <a href="{{ route('login') }}" class="landing-btn-register">Войти</a>
                    @endif
                @endauth
            </div>
        </div>
    </header>

    <main class="auth-main">
        @yield('content')
    </main>

</body>
</html>
