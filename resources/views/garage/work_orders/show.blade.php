@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Заказ-наряд №{{ $workOrder->id }}</h1>
    <p>Статус: <strong>{{ $workOrder->status }}</strong></p>
    @if($workOrder->client_visible_notes)
        <p>{{ $workOrder->client_visible_notes }}</p>
    @endif
    <h5>Работы и запчасти</h5>
    <div class="table-responsive">
        <table class="table table-sm table-bordered bg-white">
            <thead><tr><th>Описание</th><th>Кол-во</th><th>Цена</th><th>Сумма</th></tr></thead>
            <tbody>
                @foreach ($workOrder->lines as $line)
                    <tr>
                        <td>{{ $line->description }}</td>
                        <td>{{ $line->quantity }}</td>
                        <td>{{ number_format($line->unit_price, 2, ',', ' ') }}</td>
                        <td>{{ number_format($line->line_total, 2, ',', ' ') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <p class="fw-bold">Итого: {{ number_format($workOrder->total_amount, 2, ',', ' ') }} ₽</p>
    @if($workOrder->status === \App\Models\WorkOrder::STATUS_COMPLETED)
        <a href="{{ route('client.reviews.create', ['work_order_id' => $workOrder->id]) }}" class="btn btn-primary">Оставить отзыв</a>
    @endif
    <a href="{{ route('work-orders.index') }}" class="btn btn-secondary">Назад</a>
</div>
@endsection
