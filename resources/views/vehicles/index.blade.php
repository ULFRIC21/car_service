@extends('layouts.client')

@section('title', 'Мои автомобили')

@section('content')
<h1>Мои автомобили</h1>

<p><a href="{{ route('vehicles.create') }}">+ Добавить автомобиль</a></p>

@if ($vehicles->isEmpty())
    <p class="simple-muted">Автомобилей нет. <a href="{{ route('vehicles.create') }}">Добавить первый</a></p>
@else
    <table class="simple-table">
        <thead>
            <tr>
                <th>Марка</th>
                <th>Модель</th>
                <th>Год</th>
                <th>Номер</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vehicles as $vehicle)
                <tr>
                    <td>{{ $vehicle->brand }}</td>
                    <td>{{ $vehicle->model }}</td>
                    <td>{{ $vehicle->year ?: '—' }}</td>
                    <td>{{ $vehicle->plate_number }}</td>
                    <td>
                        <a href="{{ route('vehicles.edit', $vehicle) }}">Изменить</a>
                        |
                        <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST" style="display:inline" onsubmit="return confirm('Удалить?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="simple-link-btn">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection
