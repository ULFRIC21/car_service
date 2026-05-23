@extends('layouts.admin')

@section('title', 'Клиенты')

@section('content')
<section class="admin-section">
    <h2>Нужно позвонить <span class="admin-muted">({{ $pending->count() }})</span></h2>
    @if ($pending->isEmpty())
        <p class="admin-empty">Новых регистраций нет.</p>
    @else
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ФИО</th>
                    <th>Телефон</th>
                    <th>Email</th>
                    <th>Зарегистрирован</th>
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
                                <button type="submit" class="admin-btn">Позвонили</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</section>

<section class="admin-section">
    <h2>Уже позвонили <span class="admin-muted">({{ $contacted->count() }})</span></h2>
    @if ($contacted->isEmpty())
        <p class="admin-empty">Пока никого не отмечали.</p>
    @else
        <table class="admin-table">
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
</section>
@endsection
