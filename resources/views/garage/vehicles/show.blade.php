@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">{{ $vehicle->plate }}</h1>
    <dl class="row">
        <dt class="col-sm-3">Марка / модель</dt><dd class="col-sm-9">{{ $vehicle->brand }} {{ $vehicle->model }}</dd>
        <dt class="col-sm-3">Год</dt><dd class="col-sm-9">{{ $vehicle->year ?? '—' }}</dd>
        <dt class="col-sm-3">VIN</dt><dd class="col-sm-9">{{ $vehicle->vin ?? '—' }}</dd>
        <dt class="col-sm-3">Пробег</dt><dd class="col-sm-9">{{ $vehicle->mileage ?? '—' }}</dd>
    </dl>
    <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">К списку</a>
    <a href="{{ route('vehicles.edit', $vehicle) }}" class="btn btn-primary">Изменить</a>
</div>
@endsection
