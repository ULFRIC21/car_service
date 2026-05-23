@extends('layouts.app')

@section('title', 'Новая запись — АвтоМастер')

@section('content')
<div class="as-page-header">
    <div class="container">
        <h1>Новая запись</h1>
        <p class="text-muted mb-0">Выберите услугу и удобное время</p>
    </div>
</div>

<div class="container">
    <div class="as-card p-4" style="max-width: 640px;">
        @if ($errors->any())
            <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
        @endif
        <form method="POST" action="{{ route('appointments.store') }}">
            @csrf
            <p class="text-muted small">Контакты (сохранятся в профиле)</p>
            <div class="mb-3">
                <label class="form-label">Фамилия *</label>
                <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $user->last_name) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Имя *</label>
                <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $user->first_name) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Отчество</label>
                <input type="text" name="patronymic" class="form-control" value="{{ old('patronymic', $user->patronymic) }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Телефон *</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}" required>
            </div>
            <hr>
            <div class="mb-3">
                <label class="form-label">Услуга *</label>
                <select name="service_id" class="form-select" required>
                    @foreach ($services as $s)
                        <option value="{{ $s->id }}" {{ old('service_id') == $s->id ? 'selected' : '' }}>
                            {{ $s->name }} — {{ $s->price }} ₽
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Дата и время *</label>
                <input type="datetime-local" name="scheduled_at" class="form-control" value="{{ old('scheduled_at') }}" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Комментарий</label>
                <textarea name="client_comment" class="form-control" rows="2">{{ old('client_comment') }}</textarea>
            </div>
            <button type="submit" class="btn as-btn-cta">Записаться</button>
            <a href="{{ route('appointments.index') }}" class="btn as-btn-outline ms-2">Отмена</a>
        </form>
    </div>
</div>
@endsection
