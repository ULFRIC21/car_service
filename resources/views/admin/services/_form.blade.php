<div class="mb-2">
    <label>Название *</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $service->name ?? '') }}" required>
</div>
<div class="mb-2">
    <label>Описание</label>
    <textarea name="description" class="form-control" rows="2">{{ old('description', $service->description ?? '') }}</textarea>
</div>
<div class="mb-2">
    <label>Фото услуги</label>
    @if (!empty($service->image_path))
        <div class="mb-2">
            <img src="{{ $service->image_url }}" alt="" class="rounded" style="max-height: 120px; max-width: 100%; object-fit: cover;">
            <p class="small text-muted mb-0">В БД: <code>{{ $service->image_path }}</code></p>
        </div>
    @endif
    <input type="file" name="image" class="form-control" accept="image/jpeg,image/png,image/webp">
    <p class="small text-muted mb-1">Файл сохранится в <code>public/images/</code>, в БД — имя файла.</p>
    <input type="text" name="image_path" class="form-control mt-1" placeholder="или укажите имя файла вручную"
           value="{{ old('image_path', $service->image_path ?? '') }}">
</div>
<div class="mb-2">
    <label>Цена *</label>
    <input type="number" step="0.01" min="0" name="price" class="form-control" value="{{ old('price', $service->price ?? '') }}" required>
</div>
<div class="mb-2">
    <label>Длительность (мин) *</label>
    <input type="number" min="15" max="480" name="duration_minutes" class="form-control" value="{{ old('duration_minutes', $service->duration_minutes ?? 60) }}" required>
</div>
<div class="mb-2 form-check">
    <input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active"
        {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }}>
    <label class="form-check-label" for="is_active">Активна</label>
</div>
