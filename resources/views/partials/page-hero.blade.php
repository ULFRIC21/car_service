@php
    $heroImage = $image ?? config('site.images.workshop');
    $heroTitle = $title ?? '';
    $heroSubtitle = $subtitle ?? '';
@endphp
<section class="as-page-hero" style="--as-page-hero-bg: url('{{ $heroImage }}')">
    <div class="container">
        <nav class="as-breadcrumb" aria-label="breadcrumb">
            <a href="{{ url('/') }}">Главная</a>
            <span class="mx-2">/</span>
            <span>{{ $heroTitle }}</span>
        </nav>
        <h1>{{ $heroTitle }}</h1>
        @if($heroSubtitle)
            <p class="as-page-hero-sub">{{ $heroSubtitle }}</p>
        @endif
    </div>
</section>
