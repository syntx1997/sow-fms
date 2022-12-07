<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="utf-8">
    <meta name="keywords" content="">
	<meta name="author" content="">
	<meta name="robots" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="Stracker: Sow Feeding Management System">
	<meta property="og:title" content="Stracker: Sow Feeding Management System">
	<meta property="og:description" content="Sow Feeding Management System">
	<meta property="og:image" content="{{ asset('images/st-logo-text.png') }}">
	<meta name="format-detection" content="telephone=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ $title ?? '' }}</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">
	<link rel="stylesheet" href="{{ asset('vendor/chartist/css/chartist.min.css') }}">
    <link href="{{ asset('vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet') }}">
	<link href="{{ asset('vendor/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    @stack('css')

</head>
<body>
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        @include('partials.nav-header')
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Chat box start
        ***********************************-->
        <div class="chatbox">
            <div class="chatbox-close"></div>
            <iframe src="/chatify" title="description" style="width: 100%; height: 100%; border: 0px solid #c0c0c0"></iframe>
        </div>
        <!--**********************************
            Chat box End
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        @include('partials.header')
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        @include('partials.sidebar')
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            @yield('content')
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

        <!--**********************************
            Footer start
        ***********************************-->
        @include('partials.footer')
        <!--**********************************
            Footer end
        ***********************************-->

    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
	<script src="{{ asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
	<script src="{{ asset('vendor/chart.js/Chart.bundle.min.js') }}"></script>

	<!-- Chart piety plugin files -->
    <script src="{{ asset('vendor/peity/jquery.peity.min.js') }}"></script>

	<!-- Apex Chart -->
	<script src="{{ asset('vendor/apexchart/apexchart.js') }}"></script>

	<!-- Dashboard 1 -->
	<script src="{{ asset('js/dashboard/dashboard-1.js') }}"></script>

    <!-- SweetAlert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('js')

	<script src="{{ asset('vendor/owl-carousel/owl.carousel.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
	<script src="{{ asset('js/deznav-init.js') }}"></script>
    <script src="{{ asset('js/demo.js') }}"></script>

    <script src="{{ asset('js/global.js') }}"></script>
    <script src="{{ $js ?? '' }}"></script>
</body>
