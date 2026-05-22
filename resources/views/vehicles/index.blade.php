@extends('layouts.app')

@section('title', 'Мои автомобили — АвтоМастер')

@section('content')
<div class="as-page-header">
    <div class="container d-flex flex-wrap justify-content-between align-items-center gap-2">
        <div>
            <h1 class="mb-1">Мои автомобили</h1>
            <p class="text-muted mb-0">Список авто для записи в сервис</p>
        </div>
        <a href="{{ route('vehicles.create') }}" class="btn as-btn-cta"><i class="bi bi-plus-lg me-1"></i>Добавить</a>
    </div>
</div>

<div class="container">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="as-card overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr><th>Марка</th><th>Модель</th><th>Номер</th><th></th></tr>
                </thead>
                <tbody>
                    @forelse ($vehicles as $vehicle)
                        <tr>
                            <td>{{ $vehicle->brand }}</td>
                            <td>{{ $vehicle->model }}</td>
                            <td>{{ $vehicle->plate_number }}</td>
                            <td>
                                <a href="{{ route('vehicles.edit', $vehicle) }}" class="btn btn-sm btn-outline-primary">Изменить</a>
                                <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Удалить</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center text-muted py-4">Нет авто. <a href="{{ route('vehicles.create') }}">Добавить первое</a></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
