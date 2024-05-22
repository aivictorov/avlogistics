<!DOCTYPE html>
<html lang="ru-RU">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>@yield('title')</title>
    <meta name="Description" content="@yield('description')" />
    <meta name="Keywords" content="@yield('keywords')" />

    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

</head>

<body>
    @include('layouts.parts.header')

    @yield('content')

    @include('site.parts.section-portfolio')

    @include('layouts.parts.footer')

    <script src="/assets/jquery/jquery.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js">
        const swiper = new Swiper('.swiper', {
            // Optional parameters
            direction: 'horizontal',
            loop: true,

            // If we need pagination
            pagination: {
                el: '.swiper-pagination',
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

            // And if we need scrollbar
            scrollbar: {
                el: '.swiper-scrollbar',
            },
        });
    </script>

    <script src="/js/main.js"></script>
</body>

</html>
