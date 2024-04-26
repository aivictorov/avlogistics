<!DOCTYPE html>
<html lang="ru">

@include('layouts.parts.head')

<body>
    @include('layouts.parts.header')

    @yield('content')

    @include('layouts.parts.footer')

    <script src="/assets/jquery/jquery.js"></script>
    <script src="/js/main.js"></script>
</body>

</html>
