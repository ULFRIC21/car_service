@extends('layouts.client')

@section('title', 'Изменить автомобиль')

@section('content')
<h1>Изменить автомобиль</h1>

<form method="POST" action="{{ route('vehicles.update', $vehicle) }}" class="simple-form">
    @csrf
    @method('PUT')
    @include('vehicles._form', ['vehicle' => $vehicle])
    <p>
        <button type="submit" class="simple-btn">Сохранить</button>
        <a href="{{ route('vehicles.index') }}">Отмена</a>
    </p>
</form>
@endsection
