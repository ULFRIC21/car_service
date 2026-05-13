@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Услуги и цены</h1>
    <div class="table-responsive">
        <table class="table table-bordered bg-white">
            <thead><tr><th>Услуга</th><th>Описание</th><th>Длительность</th><th>Цена, ₽</th></tr></thead>
            <tbody>
                @forelse ($services as $s)
                    <tr>
                        <td>{{ $s->name }}</td>
                        <td>{{ $s->description }}</td>
                        <td>{{ $s->duration_minutes }} мин</td>
                        <td>{{ number_format($s->price, 2, ',', ' ') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4">Услуги пока не заведены.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
