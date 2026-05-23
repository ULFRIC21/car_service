<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Админка') — Тех Эксперт</title>
    <link href="{{ asset('css/simple.css') }}" rel="stylesheet">
    <style>
        body.simple-page { background: #f4f4f4; }
        .simple-top { border-bottom: 1px solid #ddd; }
        .simple-brand { color: #000 !important; }
    </style>
</head>
<body class="simple-page">
<header class="simple-top">
    <div class="simple-top__row">
        <span class="simple-brand">Админка</span>
        <div>
            <a href="{{ url('/') }}">На сайт</a>
            &nbsp;|&nbsp;
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">@csrf</form>
        </div>
    </div>
</header>

<main class="simple-wrap">
    @if (session('success'))
        <div class="simple-alert">{{ session('success') }}</div>
    @endif
    @yield('content')
</main>
</body>
</html>
