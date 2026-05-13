@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Заказ #{{ $order->id }}</span>
                    <span class="badge bg-{{ $order->status_color }}">{{ $order->status_label }}</span>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table">
                        <tr>
                            <th style="width: 200px;">Клиент</th>
                            <td>{{ $order->user->name }} ({{ $order->user->email }})</td>
                        </tr>
                        <tr>
                            <th>Автомобиль</th>
                            <td>{{ $order->car->brand }} {{ $order->car->model }} {{ $order->car->year ? "({$order->car->year})" : '' }}
                                @if($order->car->license_plate) <br><small class="text-muted">{{ $order->car->license_plate }}</small> @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Услуга</th>
                            <td>{{ $order->service->name }}</td>
                        </tr>
                        <tr>
                            <th>Стоимость</th>
                            <td><strong>{{ number_format($order->total_price, 0, ',', ' ') }} ₽</strong></td>
                        </tr>
                        <tr>
                            <th>Запланировано на</th>
                            <td>{{ $order->scheduled_at->format('d.m.Y H:i') }}</td>
                        </tr>
                        @if($order->completed_at)
                        <tr>
                            <th>Завершён</th>
                            <td>{{ $order->completed_at->format('d.m.Y H:i') }}</td>
                        </tr>
                        @endif
                        @if($order->description)
                        <tr>
                            <th>Комментарий</th>
                            <td>{{ $order->description }}</td>
                        </tr>
                        @endif
                        <tr>
                            <th>Создан</th>
                            <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                        </tr>
                    </table>

                    @if(Auth::user()->isAdmin())
                        <hr>
                        <h5>Изменить статус</h5>
                        <form method="POST" action="{{ route('orders.update-status', $order) }}" class="d-flex gap-2 flex-wrap">
                            @csrf
                            @method('PATCH')
                            @foreach(['pending' => 'Ожидает', 'confirmed' => 'Подтверждён', 'in_progress' => 'В работе', 'completed' => 'Завершён', 'cancelled' => 'Отменён'] as $status => $label)
                                <button type="submit" name="status" value="{{ $status }}"
                                    class="btn btn-sm {{ $order->status === $status ? 'btn-dark disabled' : 'btn-outline-secondary' }}">
                                    {{ $label }}
                                </button>
                            @endforeach
                        </form>
                    @endif

                    <div class="mt-3">
                        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Назад к заказам</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
