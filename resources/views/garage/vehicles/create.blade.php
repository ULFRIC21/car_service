@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Новый автомобиль</h1>
    @if ($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif
    <form method="post" action="{{ route('vehicles.store') }}">
        @csrf
        @include('garage.vehicles._form', ['submit' => 'Сохранить'])
    </form>
</div>
@endsection
