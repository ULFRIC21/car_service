@extends('layouts.app')

@section('title', 'Акции — АвтоМастер')

@section('content')
<div class="as-page-header">
    <div class="container">
        <h1>Акции и спецпредложения</h1>
        <p class="text-muted mb-0">Выгодные условия при записи онлайн</p>
    </div>
</div>

<div class="container mb-5">
    <div class="row g-3">
        @forelse ($promotions as $p)
            <div class="col-md-6">
                <div class="as-promo h-100">
                    <h5 class="fw-bold mb-2">{{ $p->title }}</h5>
                    <p class="mb-3 opacity-90">{{ $p->body }}</p>
                    @auth
                        @unless(auth()->user()->isAdmin())
                            <a href="{{ route('appointments.create') }}" class="btn btn-light btn-sm">Записаться по акции</a>
                        @endunless
                    @else
                        <a href="{{ route('register') }}" class="btn btn-light btn-sm">Зарегистрироваться</a>
                    @endauth
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="as-card p-4 text-center text-muted">Сейчас нет активных акций. Следите за обновлениями!</div>
            </div>
        @endforelse
    </div>
</div>
@endsection
