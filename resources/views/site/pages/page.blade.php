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
                    @if ($image_path)
                        <div class="article__avatar">
                            <img src={{ $image_path }} />
                        </div>
                    @endif
                    <div class="article__content article__content--min-height">
                        {!! $page->text !!}

                        @if ($gallery)
                            <div class="content-gallery">
                                @foreach ($gallery['items'] as $item)
                                    <a href="#!" class="content-gallery__item" title="">
                                        <img src="{{ Image::path($item['image'], '1_4') }}" alt="">
                                    </a>
                                @endforeach
                            </div>

                            <div class="content__slider">
                                <div class="swiper">
                                    <div class="swiper-wrapper">
                                        @foreach ($gallery['items'] as $item)
                                            <div class="swiper-slide">
                                                <img src={{ Image::path($item['image'], 'big') }} />
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                            </div>
                        @endif
                    </div>
                </article>
            </div>
            <div class="column column--aside">
                @include('site.sections.aside')
            </div>
        </div>

        @include('site.sections.main-portfolio')
    </main>
@endsection
