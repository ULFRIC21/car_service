@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Запчасть</h1>
    @include('garage.admin.parts._form', ['route' => route('admin.parts.update', $part), 'method' => 'PUT', 'part' => $part])
    <form method="post" action="{{ route('admin.parts.destroy', $part) }}" class="mt-2" onsubmit="return confirm('Удалить?');">
        @csrf @method('DELETE')
        <button class="btn btn-outline-danger">Удалить</button>
    </form>
</div>
@endsection
