@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Мои автомобили</h2>
        <a href="{{ route('cars.create') }}" class="btn btn-primary">+ Добавить авто</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($cars->isEmpty())
        <div class="alert alert-info">
            У вас пока нет добавленных автомобилей. <a href="{{ route('cars.create') }}">Добавьте первый!</a>
        </div>
    @else
        <div class="row">
            @foreach($cars as $car)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $car->brand }} {{ $car->model }}</h5>
                            <p class="card-text">
                                @if($car->year)<span class="badge bg-secondary">{{ $car->year }} г.</span>@endif
                                @if($car->color)<span class="badge bg-info text-dark">{{ $car->color }}</span>@endif
                            </p>
                            @if($car->license_plate)
                                <p class="mb-1"><strong>Гос. номер:</strong> {{ $car->license_plate }}</p>
                            @endif
                            @if($car->vin)
                                <p class="mb-1"><small class="text-muted">VIN: {{ $car->vin }}</small></p>
                            @endif
                            <div class="mt-3">
                                <a href="{{ route('cars.edit', $car) }}" class="btn btn-sm btn-outline-primary">Редактировать</a>
                                <form action="{{ route('cars.destroy', $car) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить автомобиль?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Удалить</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
