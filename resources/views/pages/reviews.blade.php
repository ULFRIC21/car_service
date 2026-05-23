@extends('layouts.landing')

@section('title', 'Отзывы')

@section('content')
<section class="landing-section landing-section--light">
    <div class="landing-container page-content">
        <h1 class="page-content__title">Отзывы</h1>

        <div class="reviews-empty">
            <p>Пока отзывов нет.</p>
            <p class="reviews-empty__hint">Раздел открыт для просмотра. Оставить отзыв пока нельзя.</p>
        </div>

        <p><a href="{{ url('/') }}" class="landing-link-back">← На главную</a></p>
    </div>
</section>
@endsection
