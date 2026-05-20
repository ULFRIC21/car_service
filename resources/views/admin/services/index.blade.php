@extends('layouts.admin')

@section('title', 'Услуги')

@section('content')
<h1>Услуги</h1>
<p><a href="{{ route('admin.services.create') }}">+ Добавить</a></p>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Цена</th>
            <th>Мин</th>
            <th>Активна</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($services as $service)
            <tr>
                <td>{{ $service->id }}</td>
                <td>{{ $service->name }}</td>
                <td>{{ $service->price }}</td>
                <td>{{ $service->duration_minutes }}</td>
                <td>{{ $service->is_active ? 'да' : 'нет' }}</td>
                <td>
                    <a href="{{ route('admin.services.edit', $service) }}">Изменить</a>
                    <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Удалить</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6">Нет услуг</td></tr>
        @endforelse
    </tbody>
</table>

{{ $services->links() }}
@endsection
