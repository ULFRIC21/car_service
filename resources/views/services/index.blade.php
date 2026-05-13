@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Услуги автосервиса</h2>
        @if(Auth::user()->isAdmin())
            <a href="{{ route('services.create') }}" class="btn btn-primary">+ Добавить услугу</a>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($services->isEmpty())
        <div class="alert alert-info">Список услуг пока пуст.</div>
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Услуга</th>
                        <th>Описание</th>
                        <th>Цена</th>
                        <th>Длительность</th>
                        @if(Auth::user()->isAdmin())
                            <th>Действия</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $service)
                        <tr>
                            <td><strong>{{ $service->name }}</strong></td>
                            <td>{{ $service->description ?? '—' }}</td>
                            <td>{{ number_format($service->price, 0, ',', ' ') }} ₽</td>
                            <td>{{ $service->duration_minutes }} мин.</td>
                            @if(Auth::user()->isAdmin())
                                <td>
                                    <a href="{{ route('services.edit', $service) }}" class="btn btn-sm btn-outline-primary">Ред.</a>
                                    <form action="{{ route('services.destroy', $service) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить услугу?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">Удалить</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
