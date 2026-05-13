@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Запись №{{ $appointment->id }}</h1>
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    <dl class="row">
        <dt class="col-sm-3">Дата</dt><dd class="col-sm-9">{{ $appointment->scheduled_at->format('d.m.Y H:i') }}</dd>
        <dt class="col-sm-3">Статус</dt><dd class="col-sm-9">{{ $appointment->status }}</dd>
        <dt class="col-sm-3">Авто</dt><dd class="col-sm-9">{{ $appointment->vehicle->plate }}</dd>
        <dt class="col-sm-3">Услуги</dt><dd class="col-sm-9">{{ $appointment->services->pluck('name')->join(', ') }}</dd>
        <dt class="col-sm-3">Ваш комментарий</dt><dd class="col-sm-9">{{ $appointment->client_notes ?: '—' }}</dd>
        <dt class="col-sm-3">Ответ сервиса</dt><dd class="col-sm-9">{{ $appointment->admin_notes ?: '—' }}</dd>
        @if($appointment->mechanic)
            <dt class="col-sm-3">Мастер</dt><dd class="col-sm-9">{{ $appointment->mechanic->name }}</dd>
        @endif
    </dl>
    @if (in_array($appointment->status, [\App\Models\Appointment::STATUS_PENDING, \App\Models\Appointment::STATUS_CONFIRMED]))
        <form method="post" action="{{ route('appointments.cancel', $appointment) }}" onsubmit="return confirm('Отменить запись?');">
            @csrf
            <button type="submit" class="btn btn-outline-danger">Отменить запись</button>
        </form>
    @endif
    <a href="{{ route('appointments.index') }}" class="btn btn-secondary mt-2">К списку</a>
</div>
@endsection
