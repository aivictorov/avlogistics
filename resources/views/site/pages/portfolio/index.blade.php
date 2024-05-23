@extends('site.layouts.main')

@section('title', $seo->title)
@section('description', $seo->description)
@section('keywords', $seo->keywords)

@section('content')

    <main class="main">
        <div class="container container--flex">
            <div class="column column--main">
                <article class="article">
                    @include('site.blocks.breadcrumbs')
                    <div class="article__title">
                        <h1 class="h1">{{ $page->name }}</h1>
                    </div>
                    <div class="article__content">
                        {!! $page->text !!}
                    </div>

                    @foreach ($sections as $section)
                        <div class="portfolio-list-item">
                            <a class="portfolio-anchor" name="type-{{ $section['url'] }}"></a>
                            <h2 class="portfolio-list-item-header">{{ $section['name'] }}</h2>

                            <div class="swiper portfolio-slider">
                                <div class="swiper-wrapper">
                                    @foreach ($section['items'] as $item)
                                        <a class="swiper-slide portfolio-slide" href="/portfolio/{{ $item['url'] }}">
                                            <img
                                                src="/storage/upload/portfolio_avatar/{{ $item['id'] }}/{{ $item['image']['id'] }}/sizes/page_{{ $item['image']['image'] }}">

                                            <span class="portfolio-slide-name">{{ $item['name'] }}</span>
                                            <span class="portfolio-slide-more">Подробнее</span>
                                        </a>
                                    @endforeach

                                    @if (count($section['items']) === 1)
                                        <a class="swiper-slide portfolio-slide"
                                            href="/portfolio/{{ $section['items'][0]['url'] }}">
                                            <img
                                                src="/storage/upload/portfolio_avatar/{{ $section['items'][0]['id'] }}/{{ $section['items'][0]['image']['id'] }}/sizes/page_{{ $section['items'][0]['image']['image'] }}">

                                            <span class="portfolio-slide-name">{{ $section['items'][0]['name'] }}</span>
                                            <span class="portfolio-slide-more">Подробнее</span>
                                        </a>
                                        <a class="swiper-slide portfolio-slide"
                                            href="/portfolio/{{ $section['items'][0]['url'] }}">
                                            <img
                                                src="/storage/upload/portfolio_avatar/{{ $section['items'][0]['id'] }}/{{ $section['items'][0]['image']['id'] }}/sizes/page_{{ $section['items'][0]['image']['image'] }}">

                                            <span class="portfolio-slide-name">{{ $section['items'][0]['name'] }}</span>
                                            <span class="portfolio-slide-more">Подробнее</span>
                                        </a>
                                        <a class="swiper-slide portfolio-slide"
                                            href="/portfolio/{{ $section['items'][0]['url'] }}">
                                            <img
                                                src="/storage/upload/portfolio_avatar/{{ $section['items'][0]['id'] }}/{{ $section['items'][0]['image']['id'] }}/sizes/page_{{ $section['items'][0]['image']['image'] }}">

                                            <span class="portfolio-slide-name">{{ $section['items'][0]['name'] }}</span>
                                            <span class="portfolio-slide-more">Подробнее</span>
                                        </a>
                                    @endif


                                    @if (count($section['items']) === 2)
                                        <a class="swiper-slide portfolio-slide"
                                            href="/portfolio/{{ $section['items'][0]['url'] }}">
                                            <img
                                                src="/storage/upload/portfolio_avatar/{{ $section['items'][0]['id'] }}/{{ $section['items'][0]['image']['id'] }}/sizes/page_{{ $section['items'][0]['image']['image'] }}">

                                            <span class="portfolio-slide-name">{{ $section['items'][0]['name'] }}</span>
                                            <span class="portfolio-slide-more">Подробнее</span>
                                        </a>
                                        <a class="swiper-slide portfolio-slide"
                                            href="/portfolio/{{ $section['items'][1]['url'] }}">
                                            <img
                                                src="/storage/upload/portfolio_avatar/{{ $section['items'][1]['id'] }}/{{ $section['items'][1]['image']['id'] }}/sizes/page_{{ $section['items'][1]['image']['image'] }}">

                                            <span class="portfolio-slide-name">{{ $section['items'][1]['name'] }}</span>
                                            <span class="portfolio-slide-more">Подробнее</span>
                                        </a>
                                    @endif
                                </div>

                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
                            </div>
                        </div>
                    @endforeach
                </article>
            </div>
            <div class="column column--aside">
                @include('site.sections.portfolio-aside')
            </div>
        </div>
    </main>
@endsection
