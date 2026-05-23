<p>
    <label>Марка *</label>
    <input type="text" name="brand" value="{{ old('brand', $vehicle->brand ?? '') }}" required>
</p>
<p>
    <label>Модель *</label>
    <input type="text" name="model" value="{{ old('model', $vehicle->model ?? '') }}" required>
</p>
<p>
    <label>Год</label>
    <input type="number" name="year" value="{{ old('year', $vehicle->year ?? '') }}">
</p>
<p>
    <label>Госномер *</label>
    <input type="text" name="plate_number" value="{{ old('plate_number', $vehicle->plate_number ?? '') }}" required>
</p>
<p>
    <label>VIN</label>
    <input type="text" name="vin" value="{{ old('vin', $vehicle->vin ?? '') }}">
</p>
<p>
    <label>Пробег</label>
    <input type="number" name="mileage" value="{{ old('mileage', $vehicle->mileage ?? '') }}">
</p>
<p>
    <label>Заметки</label>
    <textarea name="notes">{{ old('notes', $vehicle->notes ?? '') }}</textarea>
</p>
