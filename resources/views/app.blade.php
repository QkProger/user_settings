<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('css/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/overlayScrollbars.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/adminlte.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/onlyBootstrapModal.css') }}" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @routes
    <script type="text/javascript" src="{{ asset('js/jquery-36.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/overlayScrollbars.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/adminlte.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    @vite('resources/sass/app.scss')
    @routes
    @inertiaHead
    {{-- Template css start --}}
    @if (Request::segment(1) !== 'admin')
    <link href="{{ asset('template_css/responsive.css') }}" rel="stylesheet" />
        <link href="{{ asset('template_css/style.css') }}" rel="stylesheet" />
        <script type="text/javascript" src="{{ asset('template_css/vendor/jquery.2.2.3.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('template_css/vendor/popper.js/popper.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('template_css/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('template_css/vendor/Camera-master/scripts/jquery.mobile.customized.min.js') }}"></script>
	    <script type="text/javascript" src="{{ asset('template_css/vendor/Camera-master/scripts/jquery.easing.1.3.js') }}"></script> 
	    <script type="text/javascript" src="{{ asset('template_css/vendor/Camera-master/scripts/camera.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('template_css/vendor/menu/src/js/jquery.slimmenu.js') }}"></script>
		<script type="text/javascript" src="{{ asset('template_css/vendor/WOW-master/dist/wow.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('template_css/vendor/owl-carousel/owl.carousel.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('template_css/vendor/jquery.appear.js') }}"></script>
		<script type="text/javascript" src="{{ asset('template_css/vendor/jquery.countTo.js') }}"></script>
		<script type="text/javascript" src="{{ asset('template_css/vendor/fancybox/dist/jquery.fancybox.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/theme.js') }}"></script>
        
		<script src="js/map-script.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjQLCCbRKFhsr8BY78g2PQ0_bTyrm_YXU"></script>
		<script src="{{ asset('template_css/vendor/sanzzy-map/dist/snazzy-info-window.min.js') }}"></script>
        <script src="{{ asset('template_css/vendor/jquery.appear.js') }}"></script>
		<script src="{{ asset('template_css/vendor/jquery.countTo.js') }}"></script>
		<!-- Fancybox -->
		<script src="{{ asset('template_css/vendor/fancybox/dist/jquery.fancybox.min.js') }}"></script>
    @endif
    {{-- Template css end --}}
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    @inertia
    @vite('resources/js/app.js')
</body>

</html>
