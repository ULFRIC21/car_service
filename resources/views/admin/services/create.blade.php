@extends('layouts.admin')

@section('title', 'Новая услуга')

@section('content')
<h1>Новая услуга</h1>

<form method="POST" action="{{ route('admin.services.store') }}">
    @csrf
    @include('admin.services._form')
    <button type="submit" class="btn btn-primary">Сохранить</button>
    <a href="{{ route('admin.services.index') }}">Отмена</a>
</form>
@endsection
