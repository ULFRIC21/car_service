@extends('layouts.app')

@section('title', 'Регистрация — АвтоМастер')

@section('content')
<div class="as-auth-wrap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">
                <div class="as-auth-card row g-0">
                    <div class="col-md-5 auth-side d-none d-md-flex flex-column justify-content-between">
                        <div>
                            <h2 class="mb-3">Запись в один клик</h2>
                            <p class="text-secondary small">Ведите авто, записи и заказ-наряды в личном кабинете</p>
                        </div>
                        <img src="{{ config('site.images.car') }}" alt="" class="rounded mt-3 opacity-75" style="object-fit: cover; height: 120px; width: 100%;" loading="lazy" width="300" height="120">
                    </div>
                    <div class="col-md-7 auth-form">
                    <h3 class="fw-bold mb-2">Создать аккаунт</h3>
                    <p class="text-muted small mb-4">Записывайтесь в сервис, ведите автомобили и отслеживайте ремонт онлайн</p>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Имя</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Пароль</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="password-confirm" class="form-label">Подтверждение пароля</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                        <button type="submit" class="btn as-btn-cta w-100 mb-3">Зарегистрироваться</button>
                        <p class="text-center small text-muted mb-0">Уже есть аккаунт? <a href="{{ route('login') }}">Войти</a></p>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
