@extends('layouts.admin')

@section('title', 'Записи')

@section('content')
<h1>Записи</h1>

<form method="GET" class="mb-3">
    <select name="status" class="form-select d-inline-block w-auto">
        <option value="">Все статусы</option>
        @foreach ($statuses as $value => $label)
            <option value="{{ $value }}" {{ request('status') === $value ? 'selected' : '' }}>{{ $label }}</option>
        @endforeach
    </select>
    <button type="submit">Фильтр</button>
</form>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Клиент</th>
            <th>Телефон</th>
            <th>Услуга</th>
            <th>Дата</th>
            <th>Статус</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($appointments as $appointment)
            <tr>
                <td>{{ $appointment->id }}</td>
                <td>{{ $appointment->user->full_name }}</td>
                <td>{{ $appointment->user->phone ?? '—' }}</td>
                <td>{{ $appointment->service->name }}</td>
                <td>{{ $appointment->scheduled_at->format('d.m.Y H:i') }}</td>
                <td>{{ $appointment->status_label }}</td>
                <td><a href="{{ route('admin.appointments.show', $appointment) }}">Открыть</a></td>
            </tr>
        @empty
            <tr><td colspan="7">Записей нет</td></tr>
        @endforelse
    </tbody>
</table>

{{ $appointments->links() }}
@endsection
