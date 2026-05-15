@extends('layouts.app')

@section('title', 'Отзывы — АвтоМастер')

@section('content')
<div class="as-page-header">
    <div class="container d-flex flex-wrap justify-content-between align-items-center gap-2">
        <div>
            <h1>Отзывы клиентов</h1>
            <p class="text-muted mb-0">Реальные оценки после обслуживания</p>
        </div>
        @auth
            @unless(auth()->user()->isAdmin())
                <a href="{{ route('client.reviews.create') }}" class="btn as-btn-cta">Написать отзыв</a>
            @endunless
        @endauth
    </div>
</div>

<div class="container mb-5">
    <div class="row g-3">
        @forelse ($reviews as $r)
            <div class="col-md-6">
                <div class="as-card p-4 h-100">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <strong>{{ $r->user->name ?? 'Клиент' }}</strong>
                        <span class="as-stars">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="bi bi-star{{ $i <= $r->rating ? '-fill' : '' }}"></i>
                            @endfor
                        </span>
                    </div>
                    <p class="mb-2">{{ $r->body }}</p>
                    <small class="text-muted">{{ $r->created_at->format('d.m.Y') }}</small>
                </div>
            </div>
        @empty
            <div class="col-12"><p class="text-muted">Пока нет опубликованных отзывов.</p></div>
        @endforelse
    </div>
    <div class="mt-4">{{ $reviews->links() }}</div>
</div>
@endsection
