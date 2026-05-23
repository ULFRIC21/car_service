<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Админка') — Тех Эксперт</title>
    <link href="{{ asset('css/admin-simple.css') }}" rel="stylesheet">
</head>
<body class="admin-page">
<header class="admin-top">
    <h1>Админка</h1>
    <div class="admin-top__actions">
        <a href="{{ url('/') }}">На сайт</a>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
    </div>
</header>

<main class="admin-wrap">
    @if (session('success'))
        <div class="admin-alert">{{ session('success') }}</div>
    @endif
    @yield('content')
</main>
</body>
</html>
