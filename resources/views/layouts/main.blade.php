<!DOCTYPE html>
<html lang="ru-RU">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>@yield('title')</title>
    <meta name="Description" content="@yield('description')" />
    <meta name="Keywords" content="@yield('keywords')" />

    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    @include('layouts.parts.header')

    @yield('content')

    @include('site.parts.section-portfolio')

    @include('layouts.parts.footer')

    <script src="/assets/jquery/jquery.js"></script>
    <script src="/js/main.js"></script>
</body>

</html>
