@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Мои авто</h1>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <p><a href="{{ route('vehicles.create') }}" class="btn btn-primary btn-sm">+ Добавить авто</a>
       <a href="{{ route('home') }}" class="btn btn-secondary btn-sm">На главную</a></p>

    <table class="table table-bordered">
        <thead>
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
                <tr><td colspan="4">Нет авто</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
