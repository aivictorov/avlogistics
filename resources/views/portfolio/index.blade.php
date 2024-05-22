@extends('layouts.main')

@section('title', $seo->title)
@section('description', $seo->description)
@section('keywords', $seo->keywords)

@section('content')
    <main class="main">
        <div class="container container--aside">
            <div class="aside-page">

                @include('site.parts.breadcrumbs')

                <h1 class="page-h1">
                    {{ $page->name }}
                </h1>

                <div class="page-content">
                    {!! $page->text !!}
                </div>

                @foreach ($sections as $section)
                    <div class="portfolio-list-item">
                        <a class="portfolio-anchor" name="type-{{ $section['url'] }}"></a>
                        <h2 class="portfolio-list-item-header">{{ $section['name'] }}</h2>

                        <div class="swiper">
                            <div class="swiper-wrapper">
                                @foreach ($section['items'] as $item)
                                    <a class="swiper-slide" href="/portfolio/{{ $item['url'] }}">
                                        <img
                                            src="/storage/upload/portfolio_avatar/{{ $item['id'] }}/{{ $item['image']['id'] }}/sizes/page_{{ $item['image']['image'] }}">
                                        <span class="portfolio-slide-name">{{ $item['name'] }}</span>
                                        <span class="portfolio-slide-more">Подробнее</span>
                                    </a>
                                @endforeach
                            </div>

                            <!-- If we need pagination -->
                            <div class="swiper-pagination"></div>

                            <!-- If we need navigation buttons -->
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>

                            <!-- If we need scrollbar -->
                            <div class="swiper-scrollbar"></div>

                            {{-- 
                            <span
                                class="portfolio-slider-arrow portfolio-slider-arrow__left js-portfolio-slider-arrow__left"></span> --}}
                            {{-- <span
                                class="portfolio-slider-arrow portfolio-slider-arrow__right js-portfolio-slider-arrow__right"></span> --}}
                        </div>

                        {{-- <div class="portfolio-slider js-portfolio-slider">
                            <div class="inslider" style="width: 2000px;">
                                @foreach ($section['items'] as $item)
                                    <a class="portfolio-slide" href="/portfolio/{{ $item['url'] }}">
                                        <img
                                            src="/storage/upload/portfolio_avatar/{{ $item['id'] }}/{{ $item['image']['id'] }}/sizes/page_{{ $item['image']['image'] }}">
                                        <span class="portfolio-slide-name">{{ $item['name'] }}</span>
                                        <span class="portfolio-slide-more">Подробнее</span>
                                    </a>
                                @endforeach
                            </div>
                            <span
                                class="portfolio-slider-arrow portfolio-slider-arrow__left js-portfolio-slider-arrow__left"></span>
                            <span
                                class="portfolio-slider-arrow portfolio-slider-arrow__right js-portfolio-slider-arrow__right"></span>
                        </div> --}}
                    </div>
                @endforeach
            </div>
            @include('portfolio.parts.aside')
        </div>
    </main>
@endsection
