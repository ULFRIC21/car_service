@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Мои записи</h1>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif
    <p>
        <a href="{{ route('appointments.create') }}" class="btn btn-primary btn-sm">+ Записаться</a>
        <a href="{{ route('home') }}" class="btn btn-secondary btn-sm">На главную</a>
    </p>

    <table class="table table-bordered">
        <thead>
            <tr><th>Услуга</th><th>Дата</th><th>Статус</th><th></th></tr>
        </thead>
        <tbody>
            @forelse ($appointments as $a)
                <tr>
                    <td>{{ $a->service->name }}</td>
                    <td>{{ $a->scheduled_at->format('d.m.Y H:i') }}</td>
                    <td>{{ $a->status_label }}</td>
                    <td>
                        @if (in_array($a->status, ['pending', 'confirmed']))
                            <form action="{{ route('appointments.destroy', $a) }}" method="POST" class="d-inline" onsubmit="return confirm('Отменить?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Отменить</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">Нет записей</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
