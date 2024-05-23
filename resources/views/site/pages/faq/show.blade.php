@extends('layouts.main')

@section('title', $seo->title)
@section('description', $seo->description)
@section('keywords', $seo->keywords)

@section('content')
    <main class="main">
        <div class="container container--aside">
            <div class="aside-page">

                @include('site.parts.breadcrumbs')

                <h1 class="page-h1">{{ $page['name'] }}</h1>

                <div class="page-content">
                    Одним из основных понятий, с которым сталкивается грузоотправитель при перевозке груза железнодорожным
                    транспортом, это габарит погрузки. Что такое габарит погрузки? Какие виды габаритов погрузки
                    используются на железнодорожном транспорте. Каковы их основные размеры? Ответы на все эти вопросы Вы
                    можете найти на данной странице.

                    <div class="faq-page-questions">
                        @foreach ($faq_questions as $question)
                            <div class="faq-page-questions_item">
                                <a class="faq-anchor" name="{{ $question['url'] }}"></a>
                                <h2>{{ $question['name'] }}</h2>
                                <blockquote>
                                    {!! $question['answer'] !!}
                                </blockquote>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            @include('faq.parts.aside')

        </div>
    </main>
@endsection
