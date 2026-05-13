@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Новый заказ-наряд</h1>
    @if ($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
    <form method="get" action="{{ route('admin.work-orders.create') }}" class="mb-3">
        <label class="form-label">Клиент</label>
        <div class="input-group">
            <select name="user_id" class="form-select" onchange="this.form.submit()">
                <option value="">— выберите —</option>
                @foreach ($users as $u)
                    <option value="{{ $u->id }}" {{ (string) request('user_id') === (string) $u->id ? 'selected' : '' }}>{{ $u->name }} ({{ $u->email }})</option>
                @endforeach
            </select>
        </div>
    </form>
    @if (request('user_id') && $vehicles->isEmpty())
        <div class="alert alert-warning">У выбранного клиента нет автомобилей в базе.</div>
    @elseif (request('user_id'))
        <form method="post" action="{{ route('admin.work-orders.store') }}">
            @csrf
            <input type="hidden" name="user_id" value="{{ request('user_id') }}">
            <div class="mb-3">
                <label class="form-label">Автомобиль</label>
                <select name="vehicle_id" class="form-select" required>
                    @foreach ($vehicles as $v)
                        <option value="{{ $v->id }}">{{ $v->plate }} — {{ $v->brand }} {{ $v->model }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">ID записи (необязательно)</label>
                <input type="number" name="appointment_id" class="form-control" value="{{ old('appointment_id') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Мастер</label>
                <select name="mechanic_id" class="form-select">
                    <option value="">—</option>
                    @foreach ($users->where('is_admin', true) as $m)
                        <option value="{{ $m->id }}">{{ $m->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Комментарий для клиента</label>
                <textarea name="client_visible_notes" class="form-control" rows="2">{{ old('client_visible_notes') }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Внутренние заметки</label>
                <textarea name="internal_notes" class="form-control" rows="2">{{ old('internal_notes') }}</textarea>
            </div>
            <button class="btn btn-primary">Создать</button>
        </form>
    @endif
</div>
@endsection
