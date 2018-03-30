<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
<head>
    <meta charset="utf-8">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Mobile App Configuration -->
    @include('layouts.components.mobile')

    <title>{{ $pageTitle or '-' }}</title>

    <!-- Vendor CSS -->
    <link href="/assets/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css" rel="stylesheet">
    <link href="/assets/vendors/bower_components/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- Page Vendor CSS -->
    @stack('vendorstyles')

    <!-- CSS -->
    <link href="/assets/css/app_1.css?v={{ config('assets.version') }}" rel="stylesheet">
    <link href="/assets/css/app_2.css?v={{ config('assets.version') }}" rel="stylesheet">
    <link href="/assets/css/custom.css?v={{ config('assets.version') }}" rel="stylesheet">

    <!-- Page CSS -->
    @stack('styles')
</head>
<body>
    @if (session('status'))
        <input type="hidden" id="growl-alert" value="{{ session('status') }}">
    @endif
    @if (session('warning'))
        <input type="hidden" id="growl-warning" value="{{ session('warning') }}">
    @endif

    @include('layouts.components.header')

    <section id="main">
        @include('layouts.components.sidebar')

        {{-- <section id="content"> --}}
            <div class="container">
                @yield('content')
            </div>
        {{-- </section> --}}
    </section>

    <!-- Javascript Libraries -->
    <script src="/assets/vendors/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="/assets/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/assets/vendors/bower_components/Waves/dist/waves.min.js"></script>
    <script src="/assets/vendors/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/assets/vendors/bootstrap-growl/bootstrap-growl.min.js"></script>

    <script src="/assets/js/app.js?v={{ config('assets.version') }}"></script>

    <!-- Page Javascript -->
    @stack('scripts')
</body>
</html>
