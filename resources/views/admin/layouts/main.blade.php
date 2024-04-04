<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>@yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/admin_panel/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="/admin_panel/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/admin_panel/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="/admin_panel/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/admin_panel/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/admin_panel/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/admin_panel/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="/admin_panel/plugins/summernote/summernote-bs4.min.css">


    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">

    <link rel="stylesheet" href="/admin_panel/custom.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        {{-- @include('admin.layouts.parts.preloader') --}}

        <!-- Navbar -->
        {{-- @include('admin.layouts.parts.navbar') --}}
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('admin.layouts.parts.aside')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('title')</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            @yield('content')
        </div>
        <!-- /.content-wrapper -->

        @include('admin.layouts.parts.footer')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="/admin_panel/plugins/jquery/jquery.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="/admin_panel/plugins/jquery-ui/jquery-ui.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="/admin_panel/plugins/bootstrap/js/bootstrap.bundle.js"></script>
    <!-- bs-custom-file-input -->
    <script src="/admin_panel/plugins/bs-custom-file-input/bs-custom-file-input.js"></script>
    <!-- ChartJS -->
    {{-- <script src="/admin_panel/plugins/chart.js/Chart.js"></script> --}}
    <!-- Sparkline -->
    {{-- <script src="/admin_panel/plugins/sparklines/sparkline.js"></script> --}}
    <!-- JQVMap -->
    <script src="/admin_panel/plugins/jqvmap/jquery.vmap.js"></script>
    <script src="/admin_panel/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    {{-- <script src="/admin_panel/plugins/jquery-knob/jquery.knob.js"></script> --}}
    <!-- daterangepicker -->
    {{-- <script src="/admin_panel/plugins/moment/moment.js"></script> --}}
    <script src="/admin_panel/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    {{-- <script src="/admin_panel/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.js"></script> --}}
    <!-- Summernote -->
    <script src="/admin_panel/plugins/summernote/summernote-bs4.js"></script>
    <!-- overlayScrollbars -->
    <script src="/admin_panel/plugins/overlayScrollbars/js/jquery.overlayScrollbars.js"></script>
    <!-- AdminLTE App -->
    <script src="/admin_panel/dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="/admin_panel/dist/js/demo.js"></script> --}}
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    {{-- <script src="/admin_panel/dist/js/pages/dashboard.js"></script> --}}
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>


    <script src="/js/admin.js"></script>
</body>

</html>
