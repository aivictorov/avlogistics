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

                <div class="services-list">
                    <div class="services-list__item">Железнодорожные перевозки</div>
                    <div class="services-list__item">Разработка схем погрузки</div>
                    <div class="services-list__item">Импорт и экспорт</div>
                    <div class="services-list__item">Доставка товаров из Китая</div>
                    <div class="services-list__item">Вагонные перевозки</div>
                    <div class="services-list__item">Контейнерные перевозки</div>
                    <div class="services-list__item">Погрузо-разгрузочные работы</div>
                    <div class="services-list__item">Погрузо-разгрузочные работы</div>
                    <div class="services-list__item">Крепление грузов</div>
                </div>


            </div>
        </div>
    </section>
@endsection
