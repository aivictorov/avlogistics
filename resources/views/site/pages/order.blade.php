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

                    <div class="article__content">
                        {!! $page->text !!}
                        <p>
                            Благодарим Вас за интерес, проявленный к нашей компании. Пожалуйста, заполните форму заявки на
                            перевозку груза. Наши специалисты в кратчайшие сроки произведут расчет стоимости услуги и
                            предоставят Вам всю необходимую информацию.
                        </p>
                        <p></p>
                    </div>

                    @include('site.forms.form')
                </article>

            </div>
        </div>
    </main>
@endsection
