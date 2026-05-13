@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Отзывы клиентов</h1>
    @forelse ($reviews as $r)
        <div class="card mb-2">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <strong>{{ $r->user->name ?? 'Клиент' }}</strong>
                    <span>{{ str_repeat('★', $r->rating) }}{{ str_repeat('☆', 5 - $r->rating) }}</span>
                </div>
                <p class="mb-0 mt-2">{{ $r->body }}</p>
                <small class="text-muted">{{ $r->created_at->format('d.m.Y') }}</small>
            </div>
        </div>
    @empty
        <p>Пока нет опубликованных отзывов.</p>
    @endforelse
    <div class="mt-3">{{ $reviews->links() }}</div>
</div>
@endsection
