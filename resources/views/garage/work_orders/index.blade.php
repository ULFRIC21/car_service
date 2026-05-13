@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Мои заказ-наряды</h1>
    <div class="table-responsive">
        <table class="table table-bordered bg-white">
            <thead><tr><th>№</th><th>Авто</th><th>Статус</th><th>Сумма</th><th></th></tr></thead>
            <tbody>
                @forelse ($workOrders as $wo)
                    <tr>
                        <td>{{ $wo->id }}</td>
                        <td>{{ $wo->vehicle->plate }}</td>
                        <td>{{ $wo->status }}</td>
                        <td>{{ number_format($wo->total_amount, 2, ',', ' ') }} ₽</td>
                        <td><a href="{{ route('work-orders.show', $wo) }}">Открыть</a></td>
                    </tr>
                @empty
                    <tr><td colspan="5">Заказов пока нет.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $workOrders->links() }}
</div>
@endsection
