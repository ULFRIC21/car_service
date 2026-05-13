@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Мои отзывы</h1>
        <a href="{{ route('client.reviews.create') }}" class="btn btn-primary">Новый отзыв</a>
    </div>
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    @forelse ($reviews as $r)
        <div class="card mb-2">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <span>{{ str_repeat('★', $r->rating) }}</span>
                    <small>{{ $r->is_approved ? 'Опубликован' : 'На модерации' }}</small>
                </div>
                <p class="mb-0 mt-2">{{ $r->body }}</p>
            </div>
        </div>
    @empty
        <p>Вы ещё не оставляли отзывов.</p>
    @endforelse
    {{ $reviews->links() }}
</div>
@endsection
