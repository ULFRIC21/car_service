@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Новая запись</h1>
    @if ($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif
    <form method="POST" action="{{ route('appointments.store') }}">
        @csrf
        <div class="mb-2">
            <label>Авто *</label>
            <select name="vehicle_id" class="form-select" required>
                @foreach ($vehicles as $v)
                    <option value="{{ $v->id }}" {{ old('vehicle_id') == $v->id ? 'selected' : '' }}>
                        {{ $v->brand }} {{ $v->model }} ({{ $v->plate_number }})
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-2">
            <label>Услуга *</label>
            <select name="service_id" class="form-select" required>
                @foreach ($services as $s)
                    <option value="{{ $s->id }}" {{ old('service_id') == $s->id ? 'selected' : '' }}>
                        {{ $s->name }} — {{ $s->price }} ₽
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-2">
            <label>Дата и время *</label>
            <input type="datetime-local" name="scheduled_at" class="form-control" value="{{ old('scheduled_at') }}" required>
        </div>
        <div class="mb-2">
            <label>Комментарий</label>
            <textarea name="client_comment" class="form-control" rows="2">{{ old('client_comment') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Записаться</button>
        <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Отмена</a>
    </form>
</div>
@endsection
