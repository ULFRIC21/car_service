@extends('layouts.admin')

@section('title', 'Обзор')

@section('content')
<h1 class="fw-bold mb-4">Панель администратора</h1>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="as-dash-stat">
            <div class="icon bg-primary bg-opacity-25 text-primary"><i class="bi bi-wrench"></i></div>
            <div class="value">{{ $stats['services'] }}</div>
            <div class="label">Услуг</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="as-dash-stat">
            <div class="icon bg-warning bg-opacity-25 text-warning"><i class="bi bi-people"></i></div>
            <div class="value">{{ $stats['users'] }}</div>
            <div class="label">Пользователей</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="as-dash-stat">
            <div class="icon bg-success bg-opacity-25 text-success"><i class="bi bi-calendar-check"></i></div>
            <div class="value">{{ $stats['appointments'] }}</div>
            <div class="label">Записей (ожидают: {{ $stats['pending'] }})</div>
        </div>
    </div>
</div>

<div class="d-flex flex-wrap gap-2">
    <a href="{{ route('admin.services.index') }}" class="btn as-btn-cta">Услуги</a>
    <a href="{{ route('admin.services.create') }}" class="btn as-btn-outline">+ Услуга</a>
    <a href="{{ route('admin.appointments.index') }}" class="btn as-btn-outline">Записи</a>
</div>
@endsection
