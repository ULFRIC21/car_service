@extends('layouts.client')

@section('title', 'Новая запись')

@section('content')
<h1>Новая запись</h1>

<form method="POST" action="{{ route('appointments.store') }}" class="simple-form">
    @csrf

    <p><strong>Контакты</strong></p>
    <p>
        <label>Фамилия *</label>
        <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" required>
    </p>
    <p>
        <label>Имя *</label>
        <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}" required>
    </p>
    <p>
        <label>Отчество</label>
        <input type="text" name="patronymic" value="{{ old('patronymic', $user->patronymic) }}">
    </p>
    <p>
        <label>Телефон *</label>
        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" required>
    </p>

    <p><strong>Запись</strong></p>
    <p>
        <label>Услуга *</label>
        <select name="service_id" required>
            @foreach ($services as $s)
                <option value="{{ $s->id }}" {{ old('service_id') == $s->id ? 'selected' : '' }}>
                    {{ $s->name }} — {{ $s->price }} руб.
                </option>
            @endforeach
        </select>
    </p>
    <p>
        <label>Дата и время *</label>
        <input type="datetime-local" name="scheduled_at" value="{{ old('scheduled_at') }}" required>
    </p>
    <p>
        <label>Комментарий</label>
        <textarea name="client_comment">{{ old('client_comment') }}</textarea>
    </p>

    <p>
        <button type="submit" class="simple-btn">Записаться</button>
        <a href="{{ route('appointments.index') }}">Отмена</a>
    </p>
</form>
@endsection
