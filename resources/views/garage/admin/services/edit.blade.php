@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Редактирование услуги</h1>
    @include('garage.admin.services._form', ['route' => route('admin.services.update', $service), 'method' => 'PUT', 'service' => $service])
    <form method="post" action="{{ route('admin.services.destroy', $service) }}" class="mt-2" onsubmit="return confirm('Удалить?');">
        @csrf @method('DELETE')
        <button class="btn btn-outline-danger">Удалить</button>
    </form>
</div>
@endsection
