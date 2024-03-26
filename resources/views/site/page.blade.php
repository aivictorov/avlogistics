@extends('layouts.main')

@section('content')
    <section class="main-section main-section__container--page">
        <div class="main-section__container main-section__container--aside">
            <article class="aside-page">
                
                {{-- views/layouts/parts/breadcrumbs --}}

                <h1 class="page-h1">{{ $page->name }}</h1>

                {{-- avatar --}}

                <div class="page-content">
                    {!! $page->text !!}
                </div>

            </article>

            @include('site.parts.aside-page')
            
        </div>
    </section>
@endsection
