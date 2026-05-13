@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Редактирование акции</h1>
    @include('garage.admin.promotions._form', ['route' => route('admin.promotions.update', $promotion), 'method' => 'PUT', 'promotion' => $promotion])
    <form method="post" action="{{ route('admin.promotions.destroy', $promotion) }}" class="mt-2" onsubmit="return confirm('Удалить?');">
        @csrf @method('DELETE')
        <button class="btn btn-outline-danger">Удалить</button>
    </form>
</div>
@endsection
