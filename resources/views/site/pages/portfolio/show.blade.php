<?php use App\Models\Image; ?>

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

                    <div class="swiper mySwiper2" style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src={{ Image::path($avatar, 'big') }} class="portfolio-gallerey-bigimage" />
                            </div>
                            @foreach ($images as $image)
                                <div class="swiper-slide">
                                    <img src={{ Image::path($image, 'big') }} class="portfolio-gallerey-bigimage" />
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                    <div thumbsSlider="" class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src={{ Image::path($avatar, 'small') }}
                                    class="portfolio-gallerey-miniimage js-miniimage" />
                            </div>
                            @foreach ($images as $image)
                                <div class="swiper-slide">
                                    <img src={{ Image::path($image, 'small') }}
                                        class="portfolio-gallerey-miniimage js-miniimage" />
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="page-content">
                        {!! $page['text'] !!}
                    </div>
                </article>
            </div>

            <div class="column column--aside">
                @include('site.sections.portfolio-aside')
            </div>
        </div>
    </main>
@endsection
