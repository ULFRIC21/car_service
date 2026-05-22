@extends('layouts.app')

@section('title', 'Обратный звонок — АвтоМастер')
@section('main_class', 'as-main--flush')

@section('content')
@include('partials.page-hero', [
    'title' => 'Заказать обратный звонок',
    'subtitle' => 'Перезвоним в течение 15 минут в рабочее время — Пн–Сб 9:00–20:00.',
    'image' => config('site.images.diagnostic'),
])

<div class="as-section pt-0">
    <div class="container mb-5">
        <div class="as-callback-grid">
            <div class="as-card p-4 p-lg-5">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                    </div>
                @endif
                <h3 class="fw-bold mb-1">Оставьте заявку</h3>
                <p class="text-muted small mb-4">Менеджер уточнит услугу и предложит удобное время в сервисе</p>
                <form method="post" action="{{ route('callback.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Ваше имя</label>
                        <input type="text" name="name" class="form-control form-control-lg" value="{{ old('name') }}" required placeholder="Иван">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Телефон</label>
                        <input type="tel" name="phone" class="form-control form-control-lg" value="{{ old('phone') }}" required placeholder="+7 (999) 000-00-00">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Что вас интересует?</label>
                        <textarea name="message" class="form-control" rows="3" placeholder="Например: замена масла, диагностика ходовой...">{{ old('message') }}</textarea>
                    </div>
                    <button type="submit" class="btn as-btn-cta btn-lg w-100">
                        <i class="bi bi-telephone-outbound me-2"></i>Жду звонка
                    </button>
                </form>
            </div>
            <aside class="as-contact-panel">
                <h4 class="fw-bold mb-3">Контакты сервиса</h4>
                <p class="small opacity-75 mb-4">Или позвоните напрямую — ответим на вопросы по ремонту и записи.</p>
                <p class="mb-2"><i class="bi bi-telephone-fill me-2 text-warning"></i><a href="tel:+74951234567" class="fs-5 fw-bold text-white text-decoration-none">+7 (495) 123-45-67</a></p>
                <p class="mb-2"><i class="bi bi-geo-alt me-2"></i>Москва, ул. Сервисная, 12</p>
                <p class="mb-4"><i class="bi bi-clock me-2"></i>Пн–Сб 9:00–20:00</p>
                <img src="{{ config('site.images.workshop') }}" alt="Автосервис" class="rounded mt-2 w-100 opacity-75" style="max-height: 140px; object-fit: cover;" loading="lazy" width="380" height="140">
            </aside>
        </div>
    </div>
</div>
@endsection
