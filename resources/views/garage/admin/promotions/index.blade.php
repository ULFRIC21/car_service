@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h1>Акции (админ)</h1>
        <a href="{{ route('admin.promotions.create') }}" class="btn btn-primary">Новая</a>
    </div>
    @if (session('status'))<div class="alert alert-success">{{ session('status') }}</div>@endif
    <table class="table table-bordered bg-white">
        <thead><tr><th>Заголовок</th><th>Активна</th><th></th></tr></thead>
        <tbody>
            @foreach ($promotions as $p)
                <tr>
                    <td>{{ $p->title }}</td>
                    <td>{{ $p->is_active ? 'да' : 'нет' }}</td>
                    <td><a href="{{ route('admin.promotions.edit', $p) }}">Изменить</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $promotions->links() }}
</div>
@endsection
