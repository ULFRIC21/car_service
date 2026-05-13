<div class="mb-3">
    <label class="form-label">Госномер</label>
    <input type="text" name="plate" class="form-control" value="{{ old('plate', optional($vehicle ?? null)->plate) }}" required>
</div>
<div class="mb-3">
    <label class="form-label">Марка</label>
    <input type="text" name="brand" class="form-control" value="{{ old('brand', optional($vehicle ?? null)->brand) }}" required>
</div>
<div class="mb-3">
    <label class="form-label">Модель</label>
    <input type="text" name="model" class="form-control" value="{{ old('model', optional($vehicle ?? null)->model) }}" required>
</div>
<div class="mb-3">
    <label class="form-label">Год</label>
    <input type="number" name="year" class="form-control" value="{{ old('year', optional($vehicle ?? null)->year) }}">
</div>
<div class="mb-3">
    <label class="form-label">VIN</label>
    <input type="text" name="vin" class="form-control" value="{{ old('vin', optional($vehicle ?? null)->vin) }}">
</div>
<div class="mb-3">
    <label class="form-label">Пробег</label>
    <input type="number" name="mileage" class="form-control" value="{{ old('mileage', optional($vehicle ?? null)->mileage) }}">
</div>
<button type="submit" class="btn btn-primary">{{ $submit }}</button>
<a href="{{ route('vehicles.index') }}" class="btn btn-secondary">Назад</a>
