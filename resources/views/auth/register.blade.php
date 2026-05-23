@extends('layouts.landing-auth')

@section('title', 'Регистрация')

@section('content')
<div class="landing-container auth-box">
    <h1 class="auth-box__title">Регистрация</h1>

    @if ($errors->any())
        <ul class="auth-box__errors">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('register') }}" class="auth-box__form">
        @csrf

        <label class="auth-box__label" for="last_name">Фамилия</label>
        <input id="last_name" type="text" class="auth-box__input" name="last_name" value="{{ old('last_name') }}" required autofocus>

        <label class="auth-box__label" for="first_name">Имя</label>
        <input id="first_name" type="text" class="auth-box__input" name="first_name" value="{{ old('first_name') }}" required>

        <label class="auth-box__label" for="patronymic">Отчество</label>
        <input id="patronymic" type="text" class="auth-box__input" name="patronymic" value="{{ old('patronymic') }}">

        <label class="auth-box__label" for="phone">Телефон</label>
        <input id="phone" type="text" class="auth-box__input" name="phone" value="{{ old('phone') }}" placeholder="8 800 535 353">

        <label class="auth-box__label" for="email">Email</label>
        <input id="email" type="email" class="auth-box__input" name="email" value="{{ old('email') }}" required>

        <label class="auth-box__label" for="password">Пароль</label>
        <input id="password" type="password" class="auth-box__input" name="password" required>

        <label class="auth-box__label" for="password-confirm">Подтверждение пароля</label>
        <input id="password-confirm" type="password" class="auth-box__input" name="password_confirmation" required>

        <button type="submit" class="auth-box__btn">Зарегистрироваться</button>
    </form>

    <p class="auth-box__footer">
        Уже есть аккаунт? <a href="{{ route('login') }}">Войти</a>
    </p>
</div>
@endsection
