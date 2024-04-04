@extends('layouts.main')

@section('title', $seo->title)
@section('description', $seo->description)
@section('keywords', $seo->keywords)

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

                <div class="faq-list">
                    <a class="faq-header-name" href="/faq/gabarity-pogruzki/">Габариты погрузки</a>
                    <div class="asnnounce">
                        Одним из основных понятий, с которым сталкивается грузоотправитель при перевозке груза
                        железнодорожным транспортом, это габарит погрузки. Что такое габарит погрузки? Какие виды габаритов
                        погрузки используются на железнодорожном транспорте. Каковы их основные размеры? Ответы на все эти
                        вопросы Вы можете найти на данной странице. </div>
                    <ul>
                        <li>
                            <a href="/faq/gabarity-pogruzki/#chto-takoe-gabarit-pogruzki">
                                Что такое габарит погрузки?
                            </a>
                        </li>
                        <li>
                            <a href="/faq/gabarity-pogruzki/#kakie-suschestvuyut-vidy-gabaritov-pogruzki">
                                Какие существуют виды габаритов погрузки?
                            </a>
                        </li>
                    </ul>

                    <a class="faq-header-name" href="/faq/negabaritnye-gruzy/">Негабаритные грузы</a>
                    <div class="asnnounce">
                    </div>
                    <ul>
                        <li>
                            <a href="/faq/negabaritnye-gruzy/#kakoy-gruz-yavlyaetsya-negabaritnym">
                                Какой груз является негабаритным?
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            @include('faq.parts.aside')
        </div>
    </section>
@endsection
