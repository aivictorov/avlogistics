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
                        <h1 class="h1">
                            {{ $page->name }}
                        </h1>
                    </div>
                    <div class="article__content">
                        {!! $page->text !!}
                    </div>
                    <section class="faq">
                        @foreach ($faq_categories as $category)
                            <h2>
                                <a class="faq__block-header" href="/faq/{{ $category['url'] }}">{{ $category['name'] }}</a>
                            </h2>
                            {{-- @if ($category['announce'])
                                <div class="faq__block-announce">
                                    {!! $category['announce'] !!}
                                </div>
                            @endif --}}
                            <ul class="faq__block-list">
                                @foreach ($category['items'] as $item)
                                    <li>
                                        <a href="/faq/{{ $category['url'] }}#{{ $item['url'] }}">
                                            {{ $item['name'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endforeach
                    </section>
                </article>
            </div>
            <div class="column column--aside">
                @include('site.sections.faq-aside')
            </div>
        </div>
    </main>
@endsection
