@extends('layouts.client')

@section('title', 'Мои записи')

@section('content')
<h1>Мои записи</h1>

<p><a href="{{ route('appointments.create') }}">+ Новая запись</a></p>

@if ($appointments->isEmpty())
    <p class="simple-muted">Записей нет. <a href="{{ route('appointments.create') }}">Создать первую</a></p>
@else
    <table class="simple-table">
        <thead>
            <tr>
                <th>Услуга</th>
                <th>Дата</th>
                <th>Статус</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appointments as $a)
                <tr>
                    <td>{{ $a->service->name }}</td>
                    <td>{{ $a->scheduled_at->format('d.m.Y H:i') }}</td>
                    <td>{{ $a->status_label }}</td>
                    <td>
                        @if (in_array($a->status, ['pending', 'confirmed']))
                            <form action="{{ route('appointments.destroy', $a) }}" method="POST" style="display:inline" onsubmit="return confirm('Отменить запись?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="simple-link-btn">Отменить</button>
                            </form>
                        @else
                            —
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection
