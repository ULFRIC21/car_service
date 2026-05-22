@extends('layouts.admin')

@section('title', 'Редактирование')

@section('content')
<h1>Редактирование: {{ $service->name }}</h1>

<form method="POST" action="{{ route('admin.services.update', $service) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('admin.services._form', ['service' => $service])
    <button type="submit" class="btn btn-primary">Сохранить</button>
    <a href="{{ route('admin.services.index') }}">Отмена</a>
</form>
@endsection
