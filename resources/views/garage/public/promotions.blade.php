@extends('layouts.app')

@section('title', 'Акции — АвтоМастер')
@section('main_class', 'as-main--flush')

@section('content')
@include('partials.page-hero', [
    'title' => 'Акции и спецпредложения',
    'subtitle' => 'Выгодные условия при записи онлайн — экономьте на ТО и ремонте.',
    'image' => config('site.images.car'),
])

<div class="as-section pt-0">
    <div class="container">
        <div class="row g-4">
            @forelse ($promotions as $p)
                <div class="col-md-6">
                    <div class="as-promo as-promo-with-img h-100">
                        <div class="as-promo-img d-none d-md-block">
                            <img src="{{ config('site.images.engine') }}" alt="" loading="lazy" width="140" height="100">
                        </div>
                        <div>
                            <h5 class="fw-bold mb-2">{{ $p->title }}</h5>
                            <p class="mb-3 opacity-90">{{ $p->body }}</p>
                            @auth
                                @unless(auth()->user()->isAdmin())
                                    <a href="{{ route('appointments.create') }}" class="btn btn-light btn-sm fw-semibold">Записаться по акции</a>
                                @endunless
                            @else
                                <a href="{{ route('register') }}" class="btn btn-light btn-sm fw-semibold">Зарегистрироваться</a>
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="as-card p-5 text-center">
                        <div class="as-card-icon mx-auto"><i class="bi bi-tag"></i></div>
                        <p class="text-muted mb-0">Сейчас нет активных акций. Следите за обновлениями на главной!</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
