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
                            компанию по телефону <a href="tel:+78126422640">+7 (812) 642-26-40</a> или <a
                                href="tel:+79219512984">+7 (921) 951-29-84</a>, написать в <a
                                href="https://wa.me/+79219512984">Whatsapp</a>, на электронную почту <a
                                href="mailto:info@zhd.su">info@zhd.su</a> или заполнить <a
                                href="{{ route('contactForm.show') }}">форму заявки</a> на нашем сайте. Мы в кратчайшие
                            сроки ответим на все интересующие Вас вопросы.
                        </div>
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
