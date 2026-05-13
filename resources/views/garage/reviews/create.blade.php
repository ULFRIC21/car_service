@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Новый отзыв</h1>
    @if ($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif
    <form method="post" action="{{ route('client.reviews.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Заказ-наряд (необязательно)</label>
            <select name="work_order_id" class="form-select">
                <option value="">—</option>
                @foreach ($completedOrders as $wo)
                    <option value="{{ $wo->id }}" {{ (string) old('work_order_id', optional($workOrder)->id) === (string) $wo->id ? 'selected' : '' }}>№{{ $wo->id }} {{ $wo->vehicle->plate }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Оценка</label>
            <select name="rating" class="form-select" required>
                @for ($i = 5; $i >= 1; $i--)
                    <option value="{{ $i }}" {{ (string) old('rating', '5') === (string) $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Текст</label>
            <textarea name="body" class="form-control" rows="4">{{ old('body') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
</div>
@endsection
