@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Админ-панель</h1>
    <div class="row g-3">
        <div class="col-md-4"><div class="card"><div class="card-body">Пользователей: <strong>{{ $stats['users'] }}</strong></div></div></div>
        <div class="col-md-4"><div class="card"><div class="card-body">Услуг: <strong>{{ $stats['services'] }}</strong></div></div></div>
        <div class="col-md-4"><div class="card"><div class="card-body">Запчастей SKU: <strong>{{ $stats['parts'] }}</strong></div></div></div>
        <div class="col-md-4"><div class="card"><div class="card-body">Записей «ожидает»: <strong>{{ $stats['pending_appointments'] }}</strong></div></div></div>
        <div class="col-md-4"><div class="card"><div class="card-body">Открытых заказ-нарядов: <strong>{{ $stats['open_work_orders'] }}</strong></div></div></div>
        <div class="col-md-4"><div class="card"><div class="card-body">Новых заявок на звонок: <strong>{{ $stats['new_callbacks'] }}</strong></div></div></div>
        <div class="col-md-4"><div class="card"><div class="card-body">Отзывов на модерации: <strong>{{ $stats['reviews_pending'] }}</strong></div></div></div>
    </div>
    <hr>
    <p class="mb-0"><a href="{{ route('admin.appointments.index') }}">Записи</a> ·
        <a href="{{ route('admin.work-orders.index') }}">Заказ-наряды</a> ·
        <a href="{{ route('admin.services.index') }}">Услуги</a> ·
        <a href="{{ route('admin.parts.index') }}">Склад</a> ·
        <a href="{{ route('admin.promotions.index') }}">Акции</a> ·
        <a href="{{ route('admin.callbacks.index') }}">Звонки</a> ·
        <a href="{{ route('admin.reviews.index') }}">Отзывы</a></p>
</div>
@endsection
