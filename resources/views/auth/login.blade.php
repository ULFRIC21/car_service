@extends('layouts.landing-auth')

@section('title', 'Вход')

@section('content')
<div class="landing-container auth-box">
    <h1 class="auth-box__title">Вход</h1>

    @if ($errors->any())
        <ul class="auth-box__errors">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('login') }}" class="auth-box__form">
        @csrf

        <label class="auth-box__label" for="email">Email</label>
        <input id="email" type="email" class="auth-box__input" name="email" value="{{ old('email') }}" required autofocus>

        <label class="auth-box__label" for="password">Пароль</label>
        <input id="password" type="password" class="auth-box__input" name="password" required>

        <label class="auth-box__remember">
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            Запомнить меня
        </label>

        <button type="submit" class="auth-box__btn">Войти</button>
    </form>

    @if (Route::has('password.request'))
        <p class="auth-box__footer"><a href="{{ route('password.request') }}">Забыли пароль?</a></p>
    @endif

    <p class="auth-box__footer">
        Нет аккаунта? <a href="{{ route('register') }}">Регистрация</a>
    </p>
</div>
@endsection
