@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Редактирование</h1>
    @if ($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif
    <form method="post" action="{{ route('vehicles.update', $vehicle) }}">
        @csrf
        @method('PUT')
        @include('garage.vehicles._form', ['submit' => 'Обновить'])
    </form>
    <form method="post" action="{{ route('vehicles.destroy', $vehicle) }}" class="mt-3" onsubmit="return confirm('Удалить автомобиль?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-outline-danger">Удалить</button>
    </form>
</div>
@endsection
