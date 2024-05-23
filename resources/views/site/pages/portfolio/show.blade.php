<?php use App\Models\Image; ?>

@extends('layouts.main')

@section('title', $seo->title)
@section('description', $seo->description)
@section('keywords', $seo->keywords)

@section('content')
    <main class="main">
        <div class="container container--aside">
            <article class="aside-page">

                @include('site.parts.breadcrumbs')

                <h1 class="page-h1">{{ $page['name'] }}</h1>

                {{-- <div class="js-portfoio-gallerey">
                    <div class="portfolio-gallerey">
                        <div class="portfolio-gallerey-in">
                            <img src={{ Image::path($avatar, 'big') }} class="portfolio-gallerey-bigimage" />
                            @foreach ($images as $image)
                                <img src={{ Image::path($image, 'big') }} class="portfolio-gallerey-bigimage" />
                            @endforeach
                        </div>
                        <span
                            class="portfolio-gallerey-arrow portfolio-gallerey-arrow__left js-portfolio-gallerey-arrow__left"></span>
                        <span
                            class="portfolio-gallerey-arrow portfolio-gallerey-arrow__right js-portfolio-gallerey-arrow__right"></span>
                    </div>
                    <div class="portfolio-miniimages">
                        <img src={{ Image::path($avatar, 'small') }} class="portfolio-gallerey-miniimage js-miniimage" />
                        @foreach ($images as $image)
                            <img src={{ Image::path($image, 'small') }} class="portfolio-gallerey-miniimage js-miniimage" />
                        @endforeach
                    </div>
                </div> --}}


                <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2">
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


                <div class="page-content">{!! $page['text'] !!}
                </div>
            </article>

            @include('portfolio.parts.aside')
        </div>

    </main>
@endsection
