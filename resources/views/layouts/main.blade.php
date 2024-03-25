<!DOCTYPE html>
<html lang="ru">

@include('layouts.parts.head')

<body>
    @include('layouts.parts.header')

    @yield('content')

    @include('layouts.parts.footer')

    <script src="./js/jquery-1.11.2.min.js"></script>
    <script src="./js/script.js"></script>
</body>

</html>
