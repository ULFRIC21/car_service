@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Личный кабинет</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">{{ session('status') }}</div>
                    @endif
                    <p class="mb-3">Вы вошли как <strong>{{ Auth::user()->name }}</strong>.</p>
                    <div class="row text-center mb-4">
                        <div class="col-md-4"><div class="border rounded p-2">Автомобилей<br><strong>{{ $stats['vehicles'] }}</strong></div></div>
                        <div class="col-md-4"><div class="border rounded p-2">Предстоящих записей<br><strong>{{ $stats['upcoming_appointments'] }}</strong></div></div>
                        <div class="col-md-4"><div class="border rounded p-2">Открытых заказ-нарядов<br><strong>{{ $stats['open_work_orders'] }}</strong></div></div>
                    </div>
                    @if(auth()->user()->isAdmin())
                        <div class="alert alert-info mb-3">
                            Админ: новых заявок на звонок — <strong>{{ $stats['new_callbacks'] ?? 0 }}</strong>,
                            записей в ожидании — <strong>{{ $stats['pending_appointments'] ?? 0 }}</strong>.
                            <a href="{{ route('admin.dashboard') }}">Панель управления</a>
                        </div>
                    @endif
                    <p class="mb-2">Разделы:</p>
                    <ul>
                        <li><a href="{{ route('vehicles.index') }}">Мои автомобили</a></li>
                        <li><a href="{{ route('appointments.index') }}">Запись в сервис</a></li>
                        <li><a href="{{ route('work-orders.index') }}">Мои заказ-наряды</a></li>
                        <li><a href="{{ route('client.reviews.index') }}">Мои отзывы</a></li>
                        <li><a href="{{ route('public.services') }}">Каталог услуг</a> · <a href="{{ route('public.promotions') }}">Акции</a> · <a href="{{ route('callback.create') }}">Заказать звонок</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
