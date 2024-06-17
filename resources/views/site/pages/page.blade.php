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
                    @if ($image_path)
                        <div class="article__avatar">
                            <img src={{ $image_path }} alt="{{ $page->h1 }}" />
                        </div>
                    @endif

                    <div class="article__content article__content--min-height">
                        {!! $page->text !!}

                        @if ($galleries)
                            @foreach ($galleries as $gallery)
                                <div class="content-gallery" data-id="{{ $gallery->id }}">
                                    @foreach ($gallery['items'] as $item)
                                        <a href="{{ Image::path($item['image'], 'big') }}" class="content-gallery__item"
                                            data-fancybox="gallery-{{ $gallery['id'] }}" title="{{ $item['text'] }}"
                                            data-caption="{{ $item['text'] }}">
                                            <img src="{{ Image::path($item['image'], '1_4') }}" alt="{{ $gallery->name }}">
                                        </a>
                                    @endforeach
                                </div>
                            @endforeach
                        @endif

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

                        @if (!empty($children->toArray()) || !empty($siblings->toArray()))
                            <div class="article__links article__links--mobile">
                                @if (!empty($children->toArray()))
                                    <div class="article__links-column">
                                        <div class="h2">Подробнее:</div>
                                        <ul>
                                            @foreach ($children as $child)
                                                <li><a
                                                        href={{ route('pages.show', $child['url']) }}>{{ $child['name'] }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if (!empty($siblings->toArray()))
                                    <div class="article__links-column">
                                        <div class="h2">Смотрите также:</div>
                                        <ul>
                                            @foreach ($siblings as $sibling)
                                                <li><a
                                                        href={{ route('pages.show', $sibling['url']) }}>{{ $sibling['name'] }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
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
