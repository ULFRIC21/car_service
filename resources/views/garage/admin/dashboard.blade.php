@extends('layouts.app')

@section('title', 'Админ-панель — АвтоМастер')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 fw-bold mb-1">Панель управления</h1>
        <p class="text-muted mb-0">Добро пожаловать, {{ auth()->user()->name }}</p>
    </div>
    <a href="{{ route('admin.appointments.index') }}" class="btn as-btn-cta"><i class="bi bi-calendar-plus me-1"></i>Записи</a>
</div>

<div class="row g-3 mb-4">
    <div class="col-6 col-lg-4">
        <a href="{{ route('admin.appointments.index') }}" class="text-decoration-none">
            <div class="as-dash-stat">
                <div class="icon bg-warning bg-opacity-25 text-warning"><i class="bi bi-hourglass-split"></i></div>
                <div class="value">{{ $stats['pending_appointments'] }}</div>
                <div class="label">Записей в ожидании</div>
            </div>
        </a>
    </div>
    <div class="col-6 col-lg-4">
        <a href="{{ route('admin.callbacks.index') }}" class="text-decoration-none">
            <div class="as-dash-stat">
                <div class="icon bg-danger bg-opacity-25 text-danger"><i class="bi bi-telephone-inbound"></i></div>
                <div class="value">{{ $stats['new_callbacks'] }}</div>
                <div class="label">Новых звонков</div>
            </div>
        </a>
    </div>
    <div class="col-6 col-lg-4">
        <a href="{{ route('admin.work-orders.index') }}" class="text-decoration-none">
            <div class="as-dash-stat">
                <div class="icon bg-primary bg-opacity-25 text-primary"><i class="bi bi-clipboard-data"></i></div>
                <div class="value">{{ $stats['open_work_orders'] }}</div>
                <div class="label">Открытых заказ-нарядов</div>
            </div>
        </a>
    </div>
    <div class="col-6 col-lg-3">
        <div class="as-dash-stat">
            <div class="value fs-4">{{ $stats['users'] }}</div>
            <div class="label">Пользователей</div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <a href="{{ route('admin.services.index') }}" class="text-decoration-none">
            <div class="as-dash-stat">
                <div class="value fs-4">{{ $stats['services'] }}</div>
                <div class="label">Услуг</div>
            </div>
        </a>
    </div>
    <div class="col-6 col-lg-3">
        <a href="{{ route('admin.parts.index') }}" class="text-decoration-none">
            <div class="as-dash-stat">
                <div class="value fs-4">{{ $stats['parts'] }}</div>
                <div class="label">Позиций на складе</div>
            </div>
        </a>
    </div>
    <div class="col-6 col-lg-3">
        <a href="{{ route('admin.reviews.index') }}" class="text-decoration-none">
            <div class="as-dash-stat">
                <div class="value fs-4">{{ $stats['reviews_pending'] }}</div>
                <div class="label">Отзывов на модерации</div>
            </div>
        </a>
    </div>
</div>

<div class="as-card p-4">
    <h5 class="fw-bold mb-3">Разделы</h5>
    <div class="row g-2">
        <div class="col-md-4"><a href="{{ route('admin.appointments.index') }}" class="as-quick-link"><i class="bi bi-calendar-check"></i><span>Записи клиентов</span></a></div>
        <div class="col-md-4"><a href="{{ route('admin.work-orders.index') }}" class="as-quick-link"><i class="bi bi-clipboard-data"></i><span>Заказ-наряды</span></a></div>
        <div class="col-md-4"><a href="{{ route('admin.callbacks.index') }}" class="as-quick-link"><i class="bi bi-telephone"></i><span>Заявки на звонок</span></a></div>
        <div class="col-md-4"><a href="{{ route('admin.services.index') }}" class="as-quick-link"><i class="bi bi-wrench"></i><span>Услуги и цены</span></a></div>
        <div class="col-md-4"><a href="{{ route('admin.parts.index') }}" class="as-quick-link"><i class="bi bi-box-seam"></i><span>Склад запчастей</span></a></div>
        <div class="col-md-4"><a href="{{ route('admin.promotions.index') }}" class="as-quick-link"><i class="bi bi-tag"></i><span>Акции</span></a></div>
    </div>
</div>
@endsection
