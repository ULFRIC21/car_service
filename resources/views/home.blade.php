@extends('layouts.app')

@section('title', 'Личный кабинет — АвтоМастер')

@section('content')
<div class="as-page-header">
    <div class="container">
        <h1>Здравствуйте, {{ Auth::user()->name }}!</h1>
        <p class="text-muted mb-0">Управляйте автомобилями, записями и заказ-нарядами</p>
    </div>
</div>

<div class="container">
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="as-dash-stat">
                <div class="icon bg-warning bg-opacity-25 text-warning"><i class="bi bi-car-front"></i></div>
                <div class="value">{{ $stats['vehicles'] }}</div>
                <div class="label">Автомобилей</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="as-dash-stat">
                <div class="icon bg-primary bg-opacity-25 text-primary"><i class="bi bi-calendar-event"></i></div>
                <div class="value">{{ $stats['upcoming_appointments'] }}</div>
                <div class="label">Предстоящих записей</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="as-dash-stat">
                <div class="icon bg-success bg-opacity-25 text-success"><i class="bi bi-clipboard-check"></i></div>
                <div class="value">{{ $stats['open_work_orders'] }}</div>
                <div class="label">Открытых заказ-нарядов</div>
            </div>
        </div>
    </div>

    <h5 class="fw-bold mb-3">Быстрые действия</h5>
    <div class="row g-3">
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('appointments.create') }}" class="as-quick-link">
                <i class="bi bi-calendar-plus"></i>
                <span>Записаться в сервис</span>
            </a>
        </div>
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('vehicles.index') }}" class="as-quick-link">
                <i class="bi bi-car-front"></i>
                <span>Мои автомобили</span>
            </a>
        </div>
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('appointments.index') }}" class="as-quick-link">
                <i class="bi bi-list-check"></i>
                <span>Мои записи</span>
            </a>
        </div>
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('work-orders.index') }}" class="as-quick-link">
                <i class="bi bi-file-earmark-text"></i>
                <span>Заказ-наряды</span>
            </a>
        </div>
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('client.reviews.create') }}" class="as-quick-link">
                <i class="bi bi-star"></i>
                <span>Оставить отзыв</span>
            </a>
        </div>
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('callback.create') }}" class="as-quick-link">
                <i class="bi bi-telephone"></i>
                <span>Заказать звонок</span>
            </a>
        </div>
    </div>
</div>
@endsection
