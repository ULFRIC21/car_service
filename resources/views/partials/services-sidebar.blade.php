<aside class="corporate-sidebar" aria-label="Услуги автосервиса">
    @foreach ($categories as $category)
        <div class="corporate-service-block">
            <h3 class="corporate-service-block__title">{{ $category['title'] }}</h3>
            <ul class="corporate-service-block__list {{ !empty($linked) ? 'corporate-service-block__list--links' : '' }}">
                @if (!empty($linked))
                    @foreach ($category['pages'] as $page)
                        <li>
                            <a
                                href="{{ route('services.show', $page['slug']) }}"
                                class="service-sidebar__link {{ ($activeSlug ?? '') === $page['slug'] ? 'is-active' : '' }}"
                            >{{ $page['title'] }}</a>
                        </li>
                    @endforeach
                @else
                    @foreach ($category['pages'] as $page)
                        <li>{{ $page['title'] }}</li>
                    @endforeach
                @endif
            </ul>
        </div>
    @endforeach
</aside>
