@extends('site.layouts.main')

@section('title')
    {{ $seo->title }} - Вопросы и ответы
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
                        @if ($page['announce'])
                            <div class="faq-announce">
                                {{ $page['announce'] }}
                            </div>
                        @endif
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
