@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Мои автомобили</h1>
        <a href="{{ route('vehicles.create') }}" class="btn btn-primary">Добавить</a>
    </div>
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    <div class="table-responsive">
        <table class="table table-bordered bg-white">
            <thead><tr><th>Госномер</th><th>Марка / модель</th><th>Год</th><th></th></tr></thead>
            <tbody>
                @forelse ($vehicles as $v)
                    <tr>
                        <td>{{ $v->plate }}</td>
                        <td>{{ $v->brand }} {{ $v->model }}</td>
                        <td>{{ $v->year ?? '—' }}</td>
                        <td>
                            <a href="{{ route('vehicles.show', $v) }}">Открыть</a> |
                            <a href="{{ route('vehicles.edit', $v) }}">Изменить</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4">Автомобилей пока нет.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $vehicles->links() }}
</div>
@endsection
