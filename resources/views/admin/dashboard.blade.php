@extends('layouts.admin')

@section('title', 'Главная')

@section('content')
<h1>Панель администратора</h1>

<ul>
    <li>Услуги: {{ $stats['services'] }}</li>
    <li>Пользователи: {{ $stats['users'] }}</li>
    <li>Авто: {{ $stats['vehicles'] }}</li>
    <li>Записи: {{ $stats['appointments'] }} (ожидают: {{ $stats['pending'] }})</li>
</ul>

<p>
    <a href="{{ route('admin.services.index') }}">Услуги</a> |
    <a href="{{ route('admin.services.create') }}">+ Услуга</a> |
    <a href="{{ route('admin.appointments.index') }}">Записи</a>
</p>
@endsection
