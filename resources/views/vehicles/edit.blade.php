@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Редактировать авто</h1>
    @if ($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif
    <form method="POST" action="{{ route('vehicles.update', $vehicle) }}">
        @csrf @method('PUT')
        @include('vehicles._form', ['vehicle' => $vehicle])
        <button type="submit" class="btn btn-primary">Сохранить</button>
        <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">Отмена</a>
    </form>
</div>
@endsection
