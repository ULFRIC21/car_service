@extends('layouts.app')

@section('title', 'Отзывы — АвтоМастер')
@section('main_class', 'as-main--flush')

@section('content')
@include('partials.page-hero', [
    'title' => 'Отзывы клиентов',
    'subtitle' => 'Реальные оценки после обслуживания в нашем автосервисе.',
    'image' => config('site.images.mechanic'),
])

<div class="as-section as-section--alt pt-0">
    <div class="container">
        @auth
            @unless(auth()->user()->isAdmin())
                <div class="text-end mb-4">
                    <a href="{{ route('client.reviews.create') }}" class="btn as-btn-cta"><i class="bi bi-pencil me-1"></i>Написать отзыв</a>
                </div>
            @endunless
        @endauth

        <div class="row g-4">
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
                <div class="col-12">
                    <div class="as-card p-5 text-center text-muted">Пока нет опубликованных отзывов. Будьте первым после визита!</div>
                </div>
            @endforelse
        </div>
        <div class="mt-4">{{ $reviews->links() }}</div>
    </div>
</div>
@endsection
