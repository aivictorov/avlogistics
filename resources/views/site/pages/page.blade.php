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

                    @if ($image_path)
                        <div class="article__avatar">
                            <img src={{ $image_path }} />
                        </div>
                    @endif

                    <div class="page-content">
                        {!! $page->text !!}
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
