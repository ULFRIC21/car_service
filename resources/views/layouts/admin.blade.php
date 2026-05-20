<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Админка') — {{ config('app.name', 'Car Service') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 bg-light min-vh-100 py-3">
            <p class="fw-bold px-2">Автосервис</p>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Главная</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.services.index') }}">Услуги</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.appointments.index') }}">Записи</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">На сайт</a>
                </li>
            </ul>
        </nav>
        <main class="col-md-10 py-4">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
