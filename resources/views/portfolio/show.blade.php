@extends('layouts.main')

@section('title', $seo->title)
@section('description', $seo->description)
@section('keywords', $seo->keywords)

@section('content')
    <section class="main-section main-section__container--page">
        <div class="main-section__container main-section__container--aside">
            <article class="aside-page">

                @include('site.parts.breadcrumbs')

                <h1 class="page-h1">{{ $page['name'] }}</h1>

                <div class="js-portfoio-gallerey">
                    <div class="portfolio-gallerey">
                        <div class="portfolio-gallerey-in">
                            <img src="/storage/upload/portfolio_avatar/{{ $page['id'] }}/{{ $avatar['id'] }}/sizes/big_{{ $avatar['image'] }}"
                                class="portfolio-gallerey-bigimage" />

                            @foreach ($gallery as $item)
                                <img src="/storage/upload/portfolio_image/{{ $page['id'] }}/{{ $item['id'] }}/sizes/big_{{ $item['image'] }}"
                                    class="portfolio-gallerey-bigimage" />
                            @endforeach
                        </div>
                        <span
                            class="portfolio-gallerey-arrow portfolio-gallerey-arrow__left js-portfolio-gallerey-arrow__left"></span>
                        <span
                            class="portfolio-gallerey-arrow portfolio-gallerey-arrow__right js-portfolio-gallerey-arrow__right"></span>
                    </div>
                    <div class="portfolio-miniimages">
                        <img src="/storage/upload/portfolio_avatar/{{ $page['id'] }}/{{ $avatar['id'] }}/sizes/small_{{ $avatar['image'] }}"
                            class="portfolio-gallerey-miniimage js-miniimage" />
                        @foreach ($gallery as $item)
                            <img src="/storage/upload/portfolio_image/{{ $page['id'] }}/{{ $item['id'] }}/sizes/small_{{ $item['image'] }}"
                                class="portfolio-gallerey-miniimage js-miniimage" />
                        @endforeach
                    </div>
                </div>
                <div class="page-content">{!! $page['text'] !!}
                </div>
            </article>

            @include('portfolio.parts.aside')
        </div>

    </section>
@endsection
