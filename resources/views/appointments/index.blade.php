@extends('layouts.app')

@section('title', 'Мои записи — АвтоМастер')

@section('content')
<div class="as-page-header">
    <div class="container d-flex flex-wrap justify-content-between align-items-center gap-2">
        <div>
            <h1 class="mb-1">Мои записи</h1>
            <p class="text-muted mb-0">История и предстоящие визиты в сервис</p>
        </div>
        <a href="{{ route('appointments.create') }}" class="btn as-btn-cta"><i class="bi bi-calendar-plus me-1"></i>Записаться</a>
    </div>
</div>

<div class="container">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif

    <div class="as-card overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr><th>Услуга</th><th>Дата</th><th>Статус</th><th></th></tr>
                </thead>
                <tbody>
                    @forelse ($appointments as $a)
                        <tr>
                            <td>{{ $a->service->name }}</td>
                            <td>{{ $a->scheduled_at->format('d.m.Y H:i') }}</td>
                            <td><span class="badge bg-secondary">{{ $a->status_label }}</span></td>
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
                        <tr><td colspan="4" class="text-center text-muted py-4">Нет записей. <a href="{{ route('appointments.create') }}">Создать первую</a></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
