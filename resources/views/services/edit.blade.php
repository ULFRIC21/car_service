@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Редактировать услугу</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('services.update', $service) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Название услуги *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $service->name) }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Описание</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $service->description) }}</textarea>
                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">Цена (₽) *</label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $service->price) }}" min="0" step="0.01" required>
                                @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="duration_minutes" class="form-label">Длительность (мин.) *</label>
                                <input type="number" class="form-control @error('duration_minutes') is-invalid @enderror" id="duration_minutes" name="duration_minutes" value="{{ old('duration_minutes', $service->duration_minutes) }}" min="1" required>
                                @error('duration_minutes')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Сохранить</button>
                        <a href="{{ route('services.index') }}" class="btn btn-secondary">Отмена</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
