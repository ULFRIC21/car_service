@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h1>Склад (запчасти)</h1>
        <a href="{{ route('admin.parts.create') }}" class="btn btn-primary">Добавить</a>
    </div>
    @if (session('status'))<div class="alert alert-success">{{ session('status') }}</div>@endif
    <table class="table table-bordered bg-white table-sm">
        <thead><tr><th>SKU</th><th>Название</th><th>Остаток</th><th>Цена</th><th></th></tr></thead>
        <tbody>
            @foreach ($parts as $p)
                <tr>
                    <td>{{ $p->sku }}</td>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->stock_qty }}</td>
                    <td>{{ number_format($p->unit_price, 2, ',', ' ') }}</td>
                    <td><a href="{{ route('admin.parts.edit', $p) }}">Изменить</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $parts->links() }}
</div>
@endsection
