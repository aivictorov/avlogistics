<!DOCTYPE html>
<html lang="ru">

@include('layouts.parts.head')

<body>
    @include('layouts.parts.header')

    @yield('content')

    @include('layouts.parts.footer')
</body>

</html>
