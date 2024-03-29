@extends('layouts.main')

@section('content')
    <section class="main-section main-section__container--page">
        <div class="main-section__container main-section__container--aside">
            <div class="aside-page">

                @include('site.parts.breadcrumbs')

                <h1 class="page-h1">
                    {{ $page->name }}
                </h1>

                <div class="page-content">
                    {!! $page->text !!}
                </div>

                <div class="portfolio-list-item">
                    <a class="portfolio-anchor" name="type-perevozki-buldozerov"></a>
                    <h2 class="portfolio-list-item-header">Перевозки бульдозеров</h2>
                    <div class="portfolio-slider js-portfolio-slider" id="slider-container_17" data-count="1">
                        <div class="inslider" style="width: 2000px;"><a class="portfolio-slide"
                                href="/portfolio/zhd-perevozka-buldozerov-caterpillar-d6-i-caterpillar-d8/">
                                <img src="/upload/portfolio_avatar/18/175/sizes/page_dsc02994.jpg">
                                <span class="portfolio-slide-name">Перевозка бульдозеров Caterpillar D6 и Caterpillar
                                    D8</span>
                                <span class="portfolio-slide-more">Подробнее</span>
                            </a>
                            <a class="portfolio-slide"
                                href="/portfolio/zhd-perevozka-buldozerov-caterpillar-d6-i-caterpillar-d8/">
                                <img src="/upload/portfolio_avatar/18/175/sizes/page_dsc02994.jpg">
                                <span class="portfolio-slide-name">Перевозка бульдозеров Caterpillar D6 и Caterpillar
                                    D8</span>
                                <span class="portfolio-slide-more">Подробнее</span>
                            </a>
                            <a class="portfolio-slide"
                                href="/portfolio/zhd-perevozka-buldozerov-caterpillar-d6-i-caterpillar-d8/">
                                <img src="/upload/portfolio_avatar/18/175/sizes/page_dsc02994.jpg">
                                <span class="portfolio-slide-name">Перевозка бульдозеров Caterpillar D6 и Caterpillar
                                    D8</span>
                                <span class="portfolio-slide-more">Подробнее</span>
                            </a>
                        </div>
                        <span
                            class="portfolio-slider-arrow portfolio-slider-arrow__left js-portfolio-slider-arrow__left"></span>
                        <span
                            class="portfolio-slider-arrow portfolio-slider-arrow__right js-portfolio-slider-arrow__right"></span>
                    </div>
                </div>
            </div>

            @include('portfolio.parts.aside')
        </div>

    </section>
@endsection
