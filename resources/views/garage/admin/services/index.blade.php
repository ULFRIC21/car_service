@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h1>Услуги</h1>
        <a href="{{ route('admin.services.create') }}" class="btn btn-primary">Добавить</a>
    </div>
    @if (session('status'))<div class="alert alert-success">{{ session('status') }}</div>@endif
    <table class="table table-bordered bg-white">
        <thead><tr><th>Название</th><th>Цена</th><th>Активна</th><th></th></tr></thead>
        <tbody>
            @foreach ($services as $s)
                <tr>
                    <td>{{ $s->name }}</td>
                    <td>{{ number_format($s->price, 2, ',', ' ') }}</td>
                    <td>{{ $s->is_active ? 'да' : 'нет' }}</td>
                    <td><a href="{{ route('admin.services.edit', $s) }}">Изменить</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $services->links() }}
</div>
@endsection
