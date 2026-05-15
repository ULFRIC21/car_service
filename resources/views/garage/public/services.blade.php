@extends('layouts.app')

@section('title', 'Услуги и цены — АвтоМастер')

@section('content')
<div class="as-page-header">
    <div class="container">
        <h1>Услуги и цены</h1>
        <p class="text-muted mb-0">Фиксированная стоимость работ — без скрытых доплат</p>
    </div>
</div>

<div class="container mb-5">
    <div class="row g-3 mb-4">
        @forelse ($services as $s)
            <div class="col-md-6 col-lg-4">
                <div class="as-card as-service-card h-100">
                    <div class="card-body d-flex flex-column">
                        <div class="as-card-icon"><i class="bi bi-wrench-adjustable"></i></div>
                        <h5 class="fw-bold">{{ $s->name }}</h5>
                        <p class="text-muted small flex-grow-1">{{ $s->description }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <span class="as-price">{{ number_format($s->price, 0, ',', ' ') }} ₽</span>
                            <span class="badge bg-light text-dark"><i class="bi bi-clock"></i> {{ $s->duration_minutes }} мин</span>
                        </div>
                        @auth
                            @unless(auth()->user()->isAdmin())
                                <a href="{{ route('appointments.create') }}" class="btn as-btn-cta btn-sm mt-3">Записаться</a>
                            @endunless
                        @else
                            <a href="{{ route('register') }}" class="btn as-btn-cta btn-sm mt-3">Записаться онлайн</a>
                        @endauth
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12"><p class="text-muted">Услуги пока не добавлены.</p></div>
        @endforelse
    </div>

    <div class="as-table-wrap d-none d-lg-block">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Услуга</th>
                    <th>Описание</th>
                    <th>Длительность</th>
                    <th class="text-end">Цена</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($services as $s)
                    <tr>
                        <td class="fw-semibold">{{ $s->name }}</td>
                        <td class="text-muted">{{ $s->description }}</td>
                        <td>{{ $s->duration_minutes }} мин</td>
                        <td class="text-end as-price">{{ number_format($s->price, 0, ',', ' ') }} ₽</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
