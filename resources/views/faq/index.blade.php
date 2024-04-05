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
                    @foreach ($faq_categories as $category)
                        <a class="faq-header-name" href="/faq/gabarity-pogruzki/">{{ $category['name'] }}</a>
                        <div class="announce">
                            <p>
                                {{ $category['announce'] }}
                            </p>
                        </div>
                        <ul>
                            @foreach ($category['items'] as $item)
                                <li>
                                    <a href="/faq/{{ $category['url'] }}/#{{ $item['url'] }}">
                                        {{ $item['name'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endforeach
                </div>
            </div>

            @include('faq.parts.aside')

        </div>
    </section>
@endsection
