<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="/admin_panel/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/admin_panel/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="/admin_panel/custom.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        @include('admin.layouts.parts.aside')

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('title')</h1>
                        </div>
                        <div class="col-sm-6 text-right">
                            <span>Добрый день,</span>
                            <a
                                href="{{ route('admin.users.edit', ['id' => Auth::user()->id]) }}">{{ Auth::user()->name }}</a><span>!</span>
                        </div>
                    </div>
                </div>
            </div>

            @yield('content')

        </div>

        @include('admin.layouts.parts.footer')

    </div>

    <script src="/admin_panel/plugins/jquery/jquery.js"></script>
    <script src="/admin_panel/plugins/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="/admin_panel/plugins/bs-custom-file-input/bs-custom-file-input.js"></script>
    <script src="/admin_panel/plugins/tinymce/tinymce/tinymce.min.js"></script>
    <script src="/admin_panel/dist/js/adminlte.js"></script>

    <script src="/js/admin.js"></script>
</body>

</html>
