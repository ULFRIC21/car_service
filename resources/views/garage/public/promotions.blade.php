@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Акции</h1>
    @forelse ($promotions as $p)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $p->title }}</h5>
                <p class="card-text mb-0">{{ $p->body }}</p>
            </div>
        </div>
    @empty
        <p>Сейчас нет активных акций.</p>
    @endforelse
</div>
@endsection
