@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Мои записи</h1>
        <a href="{{ route('appointments.create') }}" class="btn as-btn-cta">Новая запись</a>
    </div>
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif
    <div class="as-table-wrap">
        <table class="table table-hover align-middle mb-0">
            <thead><tr><th>Дата</th><th>Авто</th><th>Статус</th><th>Услуги</th><th></th></tr></thead>
            <tbody>
                @foreach ($appointments as $a)
                    <tr>
                        <td>{{ $a->scheduled_at->format('d.m.Y H:i') }}</td>
                        <td>{{ $a->vehicle->plate }}</td>
                        <td>{{ $a->status }}</td>
                        <td>{{ $a->services->pluck('name')->join(', ') }}</td>
                        <td><a href="{{ route('appointments.show', $a) }}">Подробнее</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $appointments->links() }}
</div>
@endsection
