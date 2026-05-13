@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Заявки на обратный звонок</h1>
    @if (session('status'))<div class="alert alert-success">{{ session('status') }}</div>@endif
    <table class="table table-bordered bg-white table-sm">
        <thead><tr><th>Дата</th><th>Имя</th><th>Телефон</th><th>Сообщение</th><th>Статус</th><th></th></tr></thead>
        <tbody>
            @foreach ($callbacks as $c)
                <tr>
                    <td>{{ $c->created_at->format('d.m.Y H:i') }}</td>
                    <td>{{ $c->name }}</td>
                    <td>{{ $c->phone }}</td>
                    <td>{{ $c->message ? \Illuminate\Support\Str::limit($c->message, 80) : '' }}</td>
                    <td>{{ $c->status }}</td>
                    <td>
                        @if($c->status === \App\Models\CallbackRequest::STATUS_NEW)
                            <form method="post" action="{{ route('admin.callbacks.update', $c) }}" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="{{ \App\Models\CallbackRequest::STATUS_DONE }}">
                                <button class="btn btn-sm btn-outline-success">Обработано</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $callbacks->links() }}
</div>
@endsection
