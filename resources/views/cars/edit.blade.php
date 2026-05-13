@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Редактировать автомобиль</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('cars.update', $car) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="brand" class="form-label">Марка *</label>
                            <input type="text" class="form-control @error('brand') is-invalid @enderror" id="brand" name="brand" value="{{ old('brand', $car->brand) }}" required>
                            @error('brand')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="model" class="form-label">Модель *</label>
                            <input type="text" class="form-control @error('model') is-invalid @enderror" id="model" name="model" value="{{ old('model', $car->model) }}" required>
                            @error('model')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="year" class="form-label">Год выпуска</label>
                                <input type="number" class="form-control @error('year') is-invalid @enderror" id="year" name="year" value="{{ old('year', $car->year) }}" min="1900" max="{{ date('Y') + 1 }}">
                                @error('year')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="color" class="form-label">Цвет</label>
                                <input type="text" class="form-control @error('color') is-invalid @enderror" id="color" name="color" value="{{ old('color', $car->color) }}">
                                @error('color')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="license_plate" class="form-label">Гос. номер</label>
                                <input type="text" class="form-control @error('license_plate') is-invalid @enderror" id="license_plate" name="license_plate" value="{{ old('license_plate', $car->license_plate) }}">
                                @error('license_plate')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="vin" class="form-label">VIN номер</label>
                            <input type="text" class="form-control @error('vin') is-invalid @enderror" id="vin" name="vin" value="{{ old('vin', $car->vin) }}" maxlength="17">
                            @error('vin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Сохранить</button>
                        <a href="{{ route('cars.index') }}" class="btn btn-secondary">Отмена</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
