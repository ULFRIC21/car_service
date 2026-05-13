@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>{{ Auth::user()->isAdmin() ? 'Все заказы' : 'Мои заказы' }}</h2>
        @if(!Auth::user()->isAdmin())
            <a href="{{ route('orders.create') }}" class="btn btn-primary">+ Новый заказ</a>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($orders->isEmpty())
        <div class="alert alert-info">
            @if(Auth::user()->isAdmin())
                Заказов пока нет.
            @else
                У вас пока нет заказов. <a href="{{ route('orders.create') }}">Создайте первый!</a>
            @endif
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        @if(Auth::user()->isAdmin())
                            <th>Клиент</th>
                        @endif
                        <th>Автомобиль</th>
                        <th>Услуга</th>
                        <th>Дата</th>
                        <th>Цена</th>
                        <th>Статус</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            @if(Auth::user()->isAdmin())
                                <td>{{ $order->user->name }}</td>
                            @endif
                            <td>{{ $order->car->brand }} {{ $order->car->model }}</td>
                            <td>{{ $order->service->name }}</td>
                            <td>{{ $order->scheduled_at->format('d.m.Y H:i') }}</td>
                            <td>{{ number_format($order->total_price, 0, ',', ' ') }} ₽</td>
                            <td><span class="badge bg-{{ $order->status_color }}">{{ $order->status_label }}</span></td>
                            <td><a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-outline-primary">Подробнее</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
