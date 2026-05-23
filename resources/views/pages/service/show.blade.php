@extends('layouts.landing')

@section('title', $service['title'])

@section('content')
<section class="landing-section landing-section--light corporate-page service-page">
    <div class="landing-container">
        <h1 class="corporate-page__title">{{ $service['title'] }}</h1>

        <div class="corporate-layout">
            <div class="corporate-main">
                <figure class="service-page__figure">
                    <img
                        src="{{ asset($service['image']) }}"
                        alt="{{ $service['title'] }}"
                        class="service-page__image"
                    >
                </figure>

                <div class="service-page__body">
                    @includeIf('pages.service.content.' . $slug)
                </div>

                <p class="corporate-cta">
                    Записаться или уточнить:
                    <a href="tel:8800535353">8 800 535 353</a>
                </p>
                <p><a href="{{ url('/') }}" class="landing-link-back">← На главную</a></p>
            </div>

            @include('partials.services-sidebar', [
                'categories' => $categories,
                'linked' => true,
                'activeSlug' => $slug,
            ])
        </div>
    </div>
</section>
@endsection
