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
                    {{-- {!! $page->text !!} --}}
                    Благодарим Вас за интерес, проявленный к нашей компании. Пожалуйста, заполните форму заявки на перевозку
                    груза. Наши специалисты в кратчайшие сроки произведут расчет стоимости услуги и предоставят Вам всю
                    необходимую информацию.
                </div>

                @include('layouts.parts.form')
            </div>
        </div>
    </section>
@endsection
