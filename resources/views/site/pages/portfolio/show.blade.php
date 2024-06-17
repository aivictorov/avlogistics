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
                        <h1 class="h1">{{ $page->h1 }}</h1>
                    </div>

                    <div class="portfolio__slider">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src={{ Image::path($avatar, 'big_') }} class="portfolio-gallerey-bigimage"
                                        alt="{{ $page->name }}" />
                                </div>
                                @foreach ($images as $image)
                                    <div class="swiper-slide">
                                        <img src={{ Image::path($image, 'big_') }} class="portfolio-gallerey-bigimage"
                                            alt="{{ $page->name }}" />
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    </div>

                    <div class="portfolio__thumbs">
                        <div class="swiper" thumbsSlider="">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src={{ Image::path($avatar, 'small_') }} alt="{{ $page->name }}" />
                                </div>
                                @foreach ($images as $image)
                                    <div class="swiper-slide">
                                        <img src={{ Image::path($image, 'small_') }} alt="{{ $page->name }}" />
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="article__content">
                        {!! $page['text'] !!}

                        <div class="article__append">
                            Если Вам необходима перевозка груза или разработка схемы погрузки, Вы можете обратиться в нашу
                            компанию по телефону
                            <a href="tel:+78126422640" target="_blank" rel="noopener noreferrer">+7 (812) 642-26-40</a>
                            или
                            <a href="tel:+79219512984" target="_blank" rel="noopener noreferrer">+7 (921) 951-29-84</a>,
                            написать в
                            <a href="https://wa.me/+79219512984" target="_blank" rel="noopener noreferrer">Whatsapp</a>,
                            на электронную почту
                            <a href="mailto:info@zhd.su" target="_blank" rel="noopener noreferrer">info@zhd.su</a>
                            или заполнить
                            <a href="{{ route('contactForm.show') }}">форму заявки</a> на нашем сайте. Мы в кратчайшие
                            сроки ответим на все интересующие Вас вопросы.
                        </div>

                        <div class="article__links">
                            @if (!empty($siblings->toArray()))
                                <div class="article__links-column">
                                    <div class="h2">Смотрите также:</div>
                                    <ul>
                                        @foreach ($siblings as $sibling)
                                            <li><a
                                                    href={{ route('portfolio.show', $sibling['url']) }}>{{ $sibling['name'] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (!empty($sections->toArray()))
                                <div class="article__links-column article__links-column--mobile">
                                    <div class="h2">Другие категории:</div>
                                    <ul>
                                        @foreach ($sections as $section)
                                            <li>
                                                <a href="/portfolio#type-{{ $section['url'] }}">{{ $section['name'] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                        </div>
                    </div>
                </article>
            </div>

            <div class="column column--aside">
                @include('site.sections.portfolio-aside')
            </div>
        </div>
    </main>
@endsection
