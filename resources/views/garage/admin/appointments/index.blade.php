@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Все записи</h1>
    <table class="table table-bordered bg-white table-sm">
        <thead><tr><th>ID</th><th>Клиент</th><th>Дата</th><th>Авто</th><th>Статус</th><th></th></tr></thead>
        <tbody>
            @foreach ($appointments as $a)
                <tr>
                    <td>{{ $a->id }}</td>
                    <td>{{ $a->user->name }}</td>
                    <td>{{ $a->scheduled_at->format('d.m.Y H:i') }}</td>
                    <td>{{ $a->vehicle->plate }}</td>
                    <td>{{ $a->status }}</td>
                    <td><a href="{{ route('admin.appointments.show', $a) }}">Открыть</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $appointments->links() }}
</div>
@endsection
