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

                    <div class="portfolio-sections">
                        @foreach ($sections as $section)
                            <div class="portfolio-section">
                                <a class="portfolio-section__anchor" name="type-{{ $section['url'] }}"></a>
                                <h2 class="portfolio-section__header">{{ $section['name'] }}</h2>

                                <div class="portfolio-section__slider">
                                    <div class="swiper">
                                        <div class="swiper-wrapper">
                                            @foreach ($section['items'] as $item)
                                                <a class="swiper-slide" href="/portfolio/{{ $item['url'] }}">
                                                    <img src="/storage/upload/portfolio_avatar/{{ $item['id'] }}/{{ $item['image']['id'] }}/sizes/big_{{ $item['image']['image'] }}"
                                                        alt="{{ $item['name'] }}">
                                                    <div class="swiper-slide-label">
                                                        <span class="swiper-slide-label__name">{{ $item['name'] }}</span>
                                                        <span class="swiper-slide-label__more">Подробнее</span>
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>

                                        <div class="swiper-button-prev"></div>
                                        <div class="swiper-button-next"></div>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </article>
            </div>
            <div class="column column--aside">
                @include('site.sections.portfolio-aside')
            </div>
        </div>
    </main>
@endsection
