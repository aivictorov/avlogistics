@extends('site.layouts.main')

@section('title', $seo->title)
@section('description', $seo->description)
@section('keywords', $seo->keywords)

@section('content')
    <main class="main">
        @include('site.sections.main-map')

        @include('site.sections.main-content')

        @include('site.sections.main-submap')

        @include('site.sections.main-portfolio')
    </main>
@endsection
