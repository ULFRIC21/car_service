@extends('layouts.admin')

@section('title', 'Запись #' . $appointment->id)

@section('content')
<h1>Запись #{{ $appointment->id }}</h1>

<p><strong>Клиент:</strong> {{ $appointment->user->full_name }} ({{ $appointment->user->email }})</p>
<p><strong>Телефон:</strong> {{ $appointment->user->phone ?? '—' }}</p>
@if ($appointment->vehicle)
    <p><strong>Авто (архив):</strong> {{ $appointment->vehicle->brand }} {{ $appointment->vehicle->model }}, {{ $appointment->vehicle->plate_number }}</p>
@endif
<p><strong>Услуга:</strong> {{ $appointment->service->name }} — {{ $appointment->price_at_booking ?? $appointment->service->price }} ₽</p>
<p><strong>Дата:</strong> {{ $appointment->scheduled_at->format('d.m.Y H:i') }}</p>
<p><strong>Статус:</strong> {{ $appointment->status_label }}</p>
@if ($appointment->client_comment)
    <p><strong>Комментарий клиента:</strong> {{ $appointment->client_comment }}</p>
@endif

<hr>

<form method="POST" action="{{ route('admin.appointments.update-status', $appointment) }}">
    @csrf
    @method('PATCH')
    <div class="mb-2">
        <label>Статус</label>
        <select name="status" class="form-select">
            @foreach ($statuses as $value => $label)
                <option value="{{ $value }}" {{ $appointment->status === $value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-2">
        <label>Мастер</label>
        <select name="mechanic_id" class="form-select">
            <option value="">— не назначен —</option>
            @foreach ($mechanics as $mechanic)
                <option value="{{ $mechanic->id }}" {{ $appointment->mechanic_id == $mechanic->id ? 'selected' : '' }}>{{ $mechanic->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-2">
        <label>Заметка админа</label>
        <textarea name="admin_comment" class="form-control" rows="2">{{ old('admin_comment', $appointment->admin_comment) }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Обновить</button>
    <a href="{{ route('admin.appointments.index') }}">К списку</a>
</form>
@endsection
