<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="/assets/adminlte/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/assets/trix/trix.css">
    <link rel="stylesheet" href="/assets/trix/trix.custom.css">
    <link rel="stylesheet" href="/assets/adminlte/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="/assets/adminlte/custom.css">
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        @include('admin.sections.nav')

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('title')</h1>
                        </div>
                    </div>
                </div>
            </div>

            @yield('content')
        </div>

        @include('admin.sections.footer')
    </div>

    <script src="/assets/jquery/jquery.min.js"></script>
    <script src="/assets/adminlte/dist/js/adminlte.js"></script>
    <script src="/assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="/assets/adminlte/plugins/bs-custom-file-input/bs-custom-file-input.js"></script>
    <script src="/assets/tinymce/tinymce/tinymce.min.js"></script>
    <script src="/assets/trix/trix.min.js"></script>
    <script src="/js/admin.js"></script>

    <script>
        function check($message = "Продолжить?") {
            return confirm($message);
        }
    </script>
</body>

</html>
