<!DOCTYPE html>
<html lang="ru-RU">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO -->
    <title>@yield('title')</title>
    <meta name="Description" content="@yield('description')" />
    <meta name="Keywords" content="@yield('keywords')" />
    <link rel="canonical" href="{{ url()->current() }}" />

    <!-- Styles -->
    <link rel="stylesheet" href="/assets/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="/assets/fancybox/fancybox.css" />
    <link rel="stylesheet" href="/assets/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/main.css">

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="120x120" href="/images/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicons/favicon-16x16.png">
    <link rel="manifest" href="/images/favicons/site.webmanifest">
    <link rel="mask-icon" href="/images/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="/images/favicons/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="/images/favicons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <!-- OpenGraph -->
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title')">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:image" content="/images/opengraph/opengraph.jpg">
</head>

<body>
    @include('site.sections.header')

    @yield('content')

    @include('site.sections.footer')

    <script src="/assets/jquery/jquery.min.js"></script>
    <script src="/assets/swiper/swiper-bundle.min.js"></script>
    <script src="/assets/fancybox/fancybox.umd.js"></script>
    <script src="/js/main.js"></script>
</body>

</html>
