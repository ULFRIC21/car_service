@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Панель управления</h2>

    @if(session('status'))
        <div class="alert alert-success" role="alert">{{ session('status') }}</div>
    @endif

    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">
                        @if(Auth::user()->isAdmin())
                            Все заказы
                        @else
                            Мои заказы
                        @endif
                    </h5>
                    <p class="card-text display-6">
                        @if(Auth::user()->isAdmin())
                            {{ \App\Models\Order::count() }}
                        @else
                            {{ Auth::user()->orders()->count() }}
                        @endif
                    </p>
                    <a href="{{ route('orders.index') }}" class="btn btn-light btn-sm">Посмотреть</a>
                </div>
            </div>
        </div>

        @if(!Auth::user()->isAdmin())
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Мои авто</h5>
                    <p class="card-text display-6">{{ Auth::user()->cars()->count() }}</p>
                    <a href="{{ route('cars.index') }}" class="btn btn-light btn-sm">Посмотреть</a>
                </div>
            </div>
        </div>
        @endif

        <div class="col-md-4 mb-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Услуги</h5>
                    <p class="card-text display-6">{{ \App\Models\Service::count() }}</p>
                    <a href="{{ route('services.index') }}" class="btn btn-light btn-sm">Посмотреть</a>
                </div>
            </div>
        </div>
    </div>

    @if(Auth::user()->isAdmin())
        <div class="card mt-3">
            <div class="card-header">Последние заказы</div>
            <div class="card-body">
                @php $recentOrders = \App\Models\Order::with(['user','car','service'])->latest()->take(5)->get(); @endphp
                @if($recentOrders->isEmpty())
                    <p class="text-muted">Заказов пока нет.</p>
                @else
                    <table class="table table-sm">
                        <thead><tr><th>#</th><th>Клиент</th><th>Авто</th><th>Услуга</th><th>Статус</th><th></th></tr></thead>
                        <tbody>
                            @foreach($recentOrders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->car->brand }} {{ $order->car->model }}</td>
                                    <td>{{ $order->service->name }}</td>
                                    <td><span class="badge bg-{{ $order->status_color }}">{{ $order->status_label }}</span></td>
                                    <td><a href="{{ route('orders.show', $order) }}">Подробнее</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    @else
        <div class="mt-3">
            <a href="{{ route('orders.create') }}" class="btn btn-lg btn-primary">Записаться на обслуживание</a>
        </div>
    @endif
</div>
@endsection
