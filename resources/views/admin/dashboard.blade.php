@extends('layouts.admin')

@section('title', 'Клиенты')

@section('content')
<h1>Заявки (регистрация на сайте)</h1>

<h2>Новые заявки ({{ $pending->count() }})</h2>
@if ($pending->isEmpty())
    <p class="simple-muted">Новых заявок нет.</p>
@else
    <table class="simple-table">
        <thead>
            <tr>
                <th>ФИО</th>
                <th>Телефон</th>
                <th>Email</th>
                <th>Регистрация</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pending as $client)
                <tr>
                    <td>{{ $client->full_name }}</td>
                    <td>{{ $client->phone ?: '—' }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->created_at->format('d.m.Y H:i') }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.clients.contacted', $client) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="simple-btn">Позвонили</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

<h2>Уже позвонили ({{ $contacted->count() }})</h2>
@if ($contacted->isEmpty())
    <p class="simple-muted">Пока никого не отмечали.</p>
@else
    <table class="simple-table">
        <thead>
            <tr>
                <th>ФИО</th>
                <th>Телефон</th>
                <th>Email</th>
                <th>Звонок</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacted as $client)
                <tr>
                    <td>{{ $client->full_name }}</td>
                    <td>{{ $client->phone ?: '—' }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->contacted_at->format('d.m.Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection
