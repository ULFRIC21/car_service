<div class="mb-2">
    <label>Марка *</label>
    <input type="text" name="brand" class="form-control" value="{{ old('brand', $vehicle->brand ?? '') }}" required>
</div>
<div class="mb-2">
    <label>Модель *</label>
    <input type="text" name="model" class="form-control" value="{{ old('model', $vehicle->model ?? '') }}" required>
</div>
<div class="mb-2">
    <label>Год</label>
    <input type="number" name="year" class="form-control" value="{{ old('year', $vehicle->year ?? '') }}">
</div>
<div class="mb-2">
    <label>Госномер *</label>
    <input type="text" name="plate_number" class="form-control" value="{{ old('plate_number', $vehicle->plate_number ?? '') }}" required>
</div>
<div class="mb-2">
    <label>VIN</label>
    <input type="text" name="vin" class="form-control" value="{{ old('vin', $vehicle->vin ?? '') }}">
</div>
<div class="mb-2">
    <label>Пробег</label>
    <input type="number" name="mileage" class="form-control" value="{{ old('mileage', $vehicle->mileage ?? '') }}">
</div>
<div class="mb-2">
    <label>Заметки</label>
    <textarea name="notes" class="form-control" rows="2">{{ old('notes', $vehicle->notes ?? '') }}</textarea>
</div>
