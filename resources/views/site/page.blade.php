@extends('layouts.main')

@section('content')
    <section class="main-section main-section__container--page">
        <div class="main-section__container main-section__container--aside">
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
    </section>
@endsection
