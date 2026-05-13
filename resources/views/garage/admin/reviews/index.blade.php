@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Модерация отзывов</h1>
    @if (session('status'))<div class="alert alert-success">{{ session('status') }}</div>@endif
    <table class="table table-bordered bg-white table-sm">
        <thead><tr><th>Дата</th><th>Клиент</th><th>Оценка</th><th>Текст</th><th>Статус</th><th></th></tr></thead>
        <tbody>
            @foreach ($reviews as $r)
                <tr>
                    <td>{{ $r->created_at->format('d.m.Y') }}</td>
                    <td>{{ $r->user->name }}</td>
                    <td>{{ $r->rating }}</td>
                    <td>{{ $r->body ? \Illuminate\Support\Str::limit($r->body, 120) : '' }}</td>
                    <td>{{ $r->is_approved ? 'OK' : 'ожидает' }}</td>
                    <td>
                        @if(! $r->is_approved)
                            <form method="post" action="{{ route('admin.reviews.approve', $r) }}" class="d-inline">@csrf<button class="btn btn-sm btn-success">Одобрить</button></form>
                        @endif
                        <form method="post" action="{{ route('admin.reviews.destroy', $r) }}" class="d-inline" onsubmit="return confirm('Удалить?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $reviews->links() }}
</div>
@endsection
