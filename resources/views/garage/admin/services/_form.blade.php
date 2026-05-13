@if ($errors->any())
    <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
@endif
<form method="post" action="{{ $route }}">
    @csrf
    @if ($method !== 'POST') @method($method) @endif
    <div class="mb-3">
        <label class="form-label">Название</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', optional($service)->name) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Описание</label>
        <textarea name="description" class="form-control" rows="2">{{ old('description', optional($service)->description) }}</textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Цена</label>
        <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', optional($service)->price) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Длительность (мин)</label>
        <input type="number" name="duration_minutes" class="form-control" value="{{ old('duration_minutes', optional($service)->duration_minutes ?? 60) }}" required>
    </div>
    <div class="form-check mb-3">
        <input type="hidden" name="is_active" value="0">
        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ (bool) old('is_active', optional($service)->is_active ?? true) ? 'checked' : '' }}>
        <label class="form-check-label" for="is_active">Активна</label>
    </div>
    <button class="btn btn-primary">Сохранить</button>
    <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Назад</a>
</form>
