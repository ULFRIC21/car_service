@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Запись в сервис</h1>
    @if ($vehicles->isEmpty())
        <div class="alert alert-warning">Сначала <a href="{{ route('vehicles.create') }}">добавьте автомобиль</a>.</div>
    @else
        @if ($errors->any())
            <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
        @endif
        <form method="post" action="{{ route('appointments.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Автомобиль</label>
                <select name="vehicle_id" class="form-select" required>
                    @foreach ($vehicles as $v)
                        <option value="{{ $v->id }}" {{ (string) old('vehicle_id') === (string) $v->id ? 'selected' : '' }}>{{ $v->plate }} — {{ $v->brand }} {{ $v->model }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Дата и время</label>
                <input type="datetime-local" name="scheduled_at" class="form-control" value="{{ old('scheduled_at') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Услуги</label>
                @foreach ($services as $s)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="services[]" value="{{ $s->id }}" id="svc{{ $s->id }}"
                            {{ collect(old('services', []))->contains((string) $s->id) ? 'checked' : '' }}>
                        <label class="form-check-label" for="svc{{ $s->id }}">{{ $s->name }} — {{ number_format($s->price, 0, ',', ' ') }} ₽</label>
                    </div>
                @endforeach
            </div>
            <div class="mb-3">
                <label class="form-label">Комментарий</label>
                <textarea name="client_notes" class="form-control" rows="2">{{ old('client_notes') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Отправить заявку</button>
        </form>
    @endif
</div>
@endsection
