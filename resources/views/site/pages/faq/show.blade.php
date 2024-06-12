@extends('site.layouts.main')

@section('title')
    {{ $seo->title }} | Вопросы и ответы
@endsection
@section('description', $seo->description)
@section('keywords', $seo->keywords)

@section('content')
    <main class="main">
        <div class="container container--flex">
            <div class="column column--main">
                <article class="article">
                    @include('site.blocks.breadcrumbs')

                    <div class="article__title">
                        <h1 class="h1">
                            {{ $page->h1 }}
                        </h1>
                    </div>
                    <div class="article__content">
                        <p>
                            Одним из основных понятий, с которым сталкивается грузоотправитель при перевозке груза
                            железнодорожным транспортом, это габарит погрузки. Что такое габарит погрузки? Какие виды
                            габаритов погрузки используются на железнодорожном транспорте. Каковы их основные размеры?
                            Ответы на все эти вопросы Вы можете найти на данной странице.
                        </p>
                        <div class="faq-questions">
                            @foreach ($faq_questions as $question)
                                <div class="faq-question">
                                    <a class="faq-question__anchor" name="{{ $question['url'] }}"></a>
                                    <div class="faq-question__title">
                                        <h2 class="h2">{{ $question['name'] }}</h2>
                                    </div>
                                    <div class="blockquote faq-question__answer">
                                        {!! $question['answer'] !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </article>
            </div>

            <div class="column column--aside">
                @include('site.sections.faq-aside')
            </div>
        </div>
    </main>
@endsection
