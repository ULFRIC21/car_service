@if ($errors->any())
    <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
@endif
<form method="post" action="{{ $route }}">
    @csrf
    @if ($method !== 'POST') @method($method) @endif
    <div class="mb-3">
        <label class="form-label">Заголовок</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', optional($promotion)->title) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Текст</label>
        <textarea name="body" class="form-control" rows="3">{{ old('body', optional($promotion)->body) }}</textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Начало</label>
        <input type="datetime-local" name="starts_at" class="form-control" value="{{ old('starts_at', optional($promotion)->starts_at ? optional($promotion)->starts_at->format('Y-m-d\TH:i') : '') }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Окончание</label>
        <input type="datetime-local" name="ends_at" class="form-control" value="{{ old('ends_at', optional($promotion)->ends_at ? optional($promotion)->ends_at->format('Y-m-d\TH:i') : '') }}">
    </div>
    <div class="form-check mb-3">
        <input type="hidden" name="is_active" value="0">
        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="pactive" {{ (bool) old('is_active', optional($promotion)->is_active ?? true) ? 'checked' : '' }}>
        <label class="form-check-label" for="pactive">Активна</label>
    </div>
    <button class="btn btn-primary">Сохранить</button>
    <a href="{{ route('admin.promotions.index') }}" class="btn btn-secondary">Назад</a>
</form>
