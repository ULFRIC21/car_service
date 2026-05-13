@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Заказ-наряд №{{ $workOrder->id }}</h1>
    @if (session('status'))<div class="alert alert-success">{{ session('status') }}</div>@endif
    @if ($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif

    <p>Клиент: {{ $workOrder->user->name }} · Авто: {{ $workOrder->vehicle->plate }}</p>
    @if($workOrder->appointment)
        <p>Связанная запись: <a href="{{ route('admin.appointments.show', $workOrder->appointment) }}">№{{ $workOrder->appointment->id }}</a></p>
    @endif

    <form method="post" action="{{ route('admin.work-orders.update', $workOrder) }}" class="mb-4">
        @csrf
        @method('PATCH')
        <div class="row g-2">
            <div class="col-md-3">
                <label class="form-label">Статус</label>
                <select name="status" class="form-select">
                    @foreach ([\App\Models\WorkOrder::STATUS_DRAFT, \App\Models\WorkOrder::STATUS_IN_PROGRESS, \App\Models\WorkOrder::STATUS_COMPLETED, \App\Models\WorkOrder::STATUS_CANCELLED] as $st)
                        <option value="{{ $st }}" {{ old('status', $workOrder->status) === $st ? 'selected' : '' }}>{{ $st }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Мастер</label>
                <select name="mechanic_id" class="form-select">
                    <option value="">—</option>
                    @foreach ($mechanics as $m)
                        <option value="{{ $m->id }}" {{ (string) old('mechanic_id', $workOrder->mechanic_id) === (string) $m->id ? 'selected' : '' }}>{{ $m->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mt-2">
            <label class="form-label">Комментарий для клиента</label>
            <textarea name="client_visible_notes" class="form-control" rows="2">{{ old('client_visible_notes', $workOrder->client_visible_notes) }}</textarea>
        </div>
        <div class="mt-2">
            <label class="form-label">Внутренние заметки</label>
            <textarea name="internal_notes" class="form-control" rows="2">{{ old('internal_notes', $workOrder->internal_notes) }}</textarea>
        </div>
        <button class="btn btn-primary mt-2">Сохранить шапку</button>
    </form>

    @if($workOrder->isEditableByAdmin())
        <h5>Добавить услугу</h5>
        <form method="post" action="{{ route('admin.work-orders.lines.store', $workOrder) }}" class="row g-2 mb-3">
            @csrf
            <input type="hidden" name="line_type" value="service">
            <div class="col-md-4">
                <select name="service_id" class="form-select" required>
                    @foreach ($services as $s)
                        <option value="{{ $s->id }}">{{ $s->name }} ({{ number_format($s->price, 0, ',', ' ') }} ₽)</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2"><input type="number" name="quantity" class="form-control" value="1" min="1" required></div>
            <div class="col-md-2"><button class="btn btn-outline-primary">+ услуга</button></div>
        </form>

        <h5>Добавить запчасть</h5>
        <form method="post" action="{{ route('admin.work-orders.lines.store', $workOrder) }}" class="row g-2 mb-3">
            @csrf
            <input type="hidden" name="line_type" value="part">
            <div class="col-md-4">
                <select name="part_id" class="form-select" required>
                    @foreach ($parts as $p)
                        <option value="{{ $p->id }}">{{ $p->sku }} — {{ $p->name }} (ост. {{ $p->stock_qty }})</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2"><input type="number" name="quantity" class="form-control" value="1" min="1" required></div>
            <div class="col-md-2"><button class="btn btn-outline-primary">+ запчасть</button></div>
        </form>

        <h5>Произвольная строка</h5>
        <form method="post" action="{{ route('admin.work-orders.lines.store', $workOrder) }}" class="row g-2 mb-4">
            @csrf
            <input type="hidden" name="line_type" value="custom">
            <div class="col-md-4"><input type="text" name="description" class="form-control" placeholder="Описание" required></div>
            <div class="col-md-2"><input type="number" name="quantity" class="form-control" value="1" min="1" required></div>
            <div class="col-md-2"><input type="number" step="0.01" name="unit_price" class="form-control" placeholder="Цена" required></div>
            <div class="col-md-2"><button class="btn btn-outline-secondary">+ строка</button></div>
        </form>

        <form method="post" action="{{ route('admin.work-orders.complete', $workOrder) }}" onsubmit="return confirm('Закрыть заказ?');" class="mb-4">
            @csrf
            <button class="btn btn-success">Завершить заказ</button>
        </form>
    @endif

    <h5>Строки заказа</h5>
    <table class="table table-bordered bg-white table-sm">
        <thead><tr><th>Описание</th><th>Кол-во</th><th>Цена</th><th>Сумма</th><th></th></tr></thead>
        <tbody>
            @foreach ($workOrder->lines as $line)
                <tr>
                    <td>{{ $line->description }}</td>
                    <td>{{ $line->quantity }}</td>
                    <td>{{ number_format($line->unit_price, 2, ',', ' ') }}</td>
                    <td>{{ number_format($line->line_total, 2, ',', ' ') }}</td>
                    <td>
                        @if($workOrder->isEditableByAdmin())
                            <form method="post" action="{{ route('admin.work-orders.lines.destroy', ['work_order' => $workOrder, 'work_order_line' => $line]) }}" onsubmit="return confirm('Удалить строку?');" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Удалить</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p class="fw-bold">Итого: {{ number_format($workOrder->total_amount, 2, ',', ' ') }} ₽</p>

    <a href="{{ route('admin.work-orders.index') }}" class="btn btn-secondary">К списку</a>
</div>
@endsection
