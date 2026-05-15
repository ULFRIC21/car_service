@extends('layouts.app')

@section('title', 'Вход — АвтоМастер')

@section('content')
<div class="as-auth-wrap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <div class="as-auth-card row g-0">
                    <div class="col-md-5 auth-side d-none d-md-flex flex-column justify-content-between">
                        <div>
                            <h2 class="mb-3">Добро пожаловать</h2>
                            <p class="text-secondary small">Войдите в личный кабинет или панель администратора</p>
                        </div>
                        <div class="small text-secondary">
                            <p class="mb-2"><strong class="text-white">Клиент:</strong> зарегистрируйтесь на сайте</p>
                            <p class="mb-0"><strong class="text-white">Админ:</strong> admin@autoservice.local / password</p>
                        </div>
                    </div>
                    <div class="col-md-7 auth-form">
                        <h3 class="fw-bold mb-4">Вход в аккаунт</h3>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Пароль</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-4 form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">Запомнить меня</label>
                            </div>
                            <button type="submit" class="btn as-btn-cta w-100 mb-3">Войти</button>
                            @if (Route::has('password.request'))
                                <p class="text-center small mb-2"><a href="{{ route('password.request') }}">Забыли пароль?</a></p>
                            @endif
                            <p class="text-center small text-muted mb-0">Нет аккаунта? <a href="{{ route('register') }}">Регистрация</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
