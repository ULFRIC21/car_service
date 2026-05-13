@if ($errors->any())
    <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
@endif
<form method="post" action="{{ $route }}">
    @csrf
    @if ($method !== 'POST') @method($method) @endif
    <div class="mb-3">
        <label class="form-label">SKU</label>
        <input type="text" name="sku" class="form-control" value="{{ old('sku', optional($part)->sku) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Название</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', optional($part)->name) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Остаток</label>
        <input type="number" name="stock_qty" class="form-control" value="{{ old('stock_qty', optional($part)->stock_qty ?? 0) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Цена</label>
        <input type="number" step="0.01" name="unit_price" class="form-control" value="{{ old('unit_price', optional($part)->unit_price) }}" required>
    </div>
    <button class="btn btn-primary">Сохранить</button>
    <a href="{{ route('admin.parts.index') }}" class="btn btn-secondary">Назад</a>
</form>
