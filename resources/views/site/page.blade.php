@extends('layouts.main')

@section('title', $seo->title)
@section('description', $seo->description)
@section('keywords', $seo->keywords)

@section('content')
    <main class="main">
        <div class="container container--aside">
            <article class="aside-page">

                @include('site.parts.breadcrumbs')

                <h1 class="page-h1">{{ $page->name }}</h1>

                @if ($image_path)
                    <div class="post-image">
                        <img src={{ $image_path }} />
                    </div>
                @endif

                <div class="page-content">
                    {!! $page->text !!}
                </div>

            </article>

            @include('site.parts.aside-page')

        </div>
    </main>
@endsection
