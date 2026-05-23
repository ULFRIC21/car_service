@extends('layouts.client')

@section('title', 'Добавить автомобиль')

@section('content')
<h1>Добавить автомобиль</h1>

<form method="POST" action="{{ route('vehicles.store') }}" class="simple-form">
    @csrf
    @include('vehicles._form')
    <p>
        <button type="submit" class="simple-btn">Сохранить</button>
        <a href="{{ route('vehicles.index') }}">Отмена</a>
    </p>
</form>
@endsection
