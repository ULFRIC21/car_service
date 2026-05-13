@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Новый заказ на обслуживание</div>
                <div class="card-body">
                    @if($cars->isEmpty())
                        <div class="alert alert-warning">
                            Сначала <a href="{{ route('cars.create') }}">добавьте автомобиль</a>, чтобы создать заказ.
                        </div>
                    @elseif($services->isEmpty())
                        <div class="alert alert-warning">
                            Нет доступных услуг. Обратитесь к администратору.
                        </div>
                    @else
                        <form method="POST" action="{{ route('orders.store') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="car_id" class="form-label">Автомобиль *</label>
                                <select class="form-select @error('car_id') is-invalid @enderror" id="car_id" name="car_id" required>
                                    <option value="">Выберите авто...</option>
                                    @foreach($cars as $car)
                                        <option value="{{ $car->id }}" {{ old('car_id') == $car->id ? 'selected' : '' }}>
                                            {{ $car->brand }} {{ $car->model }} {{ $car->year ? "({$car->year})" : '' }} {{ $car->license_plate ? "— {$car->license_plate}" : '' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('car_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label for="service_id" class="form-label">Услуга *</label>
                                <select class="form-select @error('service_id') is-invalid @enderror" id="service_id" name="service_id" required>
                                    <option value="">Выберите услугу...</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                            {{ $service->name }} — {{ number_format($service->price, 0, ',', ' ') }} ₽ ({{ $service->duration_minutes }} мин.)
                                        </option>
                                    @endforeach
                                </select>
                                @error('service_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label for="scheduled_at" class="form-label">Желаемая дата и время *</label>
                                <input type="datetime-local" class="form-control @error('scheduled_at') is-invalid @enderror" id="scheduled_at" name="scheduled_at" value="{{ old('scheduled_at') }}" required>
                                @error('scheduled_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Комментарий</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Опишите проблему или пожелания...">{{ old('description') }}</textarea>
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Создать заказ</button>
                            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Отмена</a>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
