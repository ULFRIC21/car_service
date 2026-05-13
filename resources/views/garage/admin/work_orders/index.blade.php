@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h1>Заказ-наряды</h1>
        <a href="{{ route('admin.work-orders.create') }}" class="btn btn-primary">Новый</a>
    </div>
    <table class="table table-bordered bg-white table-sm">
        <thead><tr><th>№</th><th>Клиент</th><th>Авто</th><th>Статус</th><th>Сумма</th><th></th></tr></thead>
        <tbody>
            @foreach ($workOrders as $wo)
                <tr>
                    <td>{{ $wo->id }}</td>
                    <td>{{ $wo->user->name }}</td>
                    <td>{{ $wo->vehicle->plate }}</td>
                    <td>{{ $wo->status }}</td>
                    <td>{{ number_format($wo->total_amount, 2, ',', ' ') }}</td>
                    <td><a href="{{ route('admin.work-orders.show', $wo) }}">Открыть</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $workOrders->links() }}
</div>
@endsection
