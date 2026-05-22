@extends('layouts.app')

@section('title', 'Услуги и цены — АвтоМастер')
@section('main_class', 'as-main--flush')

@section('content')
@include('partials.page-hero', [
    'title' => 'Услуги и цены',
    'subtitle' => 'Фиксированная стоимость работ — без скрытых доплат. Запись онлайн в пару кликов.',
    'image' => config('site.images.tools'),
])

<div class="as-section as-section--alt pt-0">
    <div class="container">
        <div class="row g-4 mb-4">
            @php $serviceImgs = config('site.service_images'); @endphp
            @forelse ($services as $index => $s)
                <div class="col-md-6 col-lg-4">
                    <article class="as-card as-service-card h-100">
                        <div class="as-card-img">
                            <img src="{{ $serviceImgs[$index % count($serviceImgs)] }}" alt="{{ $s->name }}" loading="lazy" width="400" height="250">
                        </div>
                        <div class="card-body d-flex flex-column">
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
                    </article>
                </div>
            @empty
                <div class="col-12"><p class="text-muted">Услуги пока не добавлены.</p></div>
            @endforelse
        </div>

        @if($services->isNotEmpty())
        <h3 class="fw-bold mb-3">Прайс-лист</h3>
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
        @endif
    </div>
</div>
@endsection
