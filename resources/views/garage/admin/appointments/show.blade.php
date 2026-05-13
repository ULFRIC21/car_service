@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Запись №{{ $appointment->id }}</h1>
    @if (session('status'))<div class="alert alert-success">{{ session('status') }}</div>@endif
    @if ($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
    <p>Клиент: {{ $appointment->user->name }} ({{ $appointment->user->email }})</p>
    <p>Авто: {{ $appointment->vehicle->plate }} {{ $appointment->vehicle->brand }} {{ $appointment->vehicle->model }}</p>
    <p>Услуги: {{ $appointment->services->pluck('name')->join(', ') }}</p>
    <p>Комментарий клиента: {{ $appointment->client_notes ?: '—' }}</p>

    @if($appointment->workOrders->isEmpty())
        <form method="post" action="{{ route('admin.appointments.work-order', $appointment) }}" class="mb-3">
            @csrf
            <button type="submit" class="btn btn-success">Создать заказ-наряд из записи</button>
        </form>
    @else
        <p>Заказ-наряд: <a href="{{ route('admin.work-orders.show', $appointment->workOrders->first()) }}">№{{ $appointment->workOrders->first()->id }}</a></p>
    @endif

    <form method="post" action="{{ route('admin.appointments.update', $appointment) }}">
        @csrf
        @method('PATCH')
        <div class="mb-2">
            <label class="form-label">Статус</label>
            <select name="status" class="form-select">
                @foreach ([\App\Models\Appointment::STATUS_PENDING, \App\Models\Appointment::STATUS_CONFIRMED, \App\Models\Appointment::STATUS_CANCELLED, \App\Models\Appointment::STATUS_COMPLETED] as $st)
                    <option value="{{ $st }}" {{ old('status', $appointment->status) === $st ? 'selected' : '' }}>{{ $st }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-2">
            <label class="form-label">Мастер</label>
            <select name="mechanic_id" class="form-select">
                <option value="">—</option>
                @foreach ($mechanics as $m)
                    <option value="{{ $m->id }}" {{ (string) old('mechanic_id', $appointment->mechanic_id) === (string) $m->id ? 'selected' : '' }}>{{ $m->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-2">
            <label class="form-label">Внутренние заметки</label>
            <textarea name="admin_notes" class="form-control" rows="2">{{ old('admin_notes', $appointment->admin_notes) }}</textarea>
        </div>
        <button class="btn btn-primary">Сохранить</button>
    </form>
    <a href="{{ route('admin.appointments.index') }}" class="btn btn-secondary mt-2">К списку</a>
</div>
@endsection
