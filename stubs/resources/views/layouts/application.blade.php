<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="material-style layout-fixed-offcanvas layout-navbar-fixed">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

	<title>{{ isset($title) ? $title . ' - ' : '' }}Laravel Starter</title>

	<!-- Main font -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900" rel="stylesheet">

	<!-- Favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="{{ mix('/favicon/apple-touch-icon.png') }}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ mix('/favicon/favicon-32x32.png') }}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ mix('/favicon/favicon-16x16.png') }}">
	<link rel="manifest" href="{{ mix('/favicon/site.webmanifest') }}">

	<!-- Icons. Uncomment required icon fonts -->
	<link rel="stylesheet" href="{{ mix('/vendor/fonts/fontawesome/css/all.css') }}">
	<link rel="stylesheet" href="{{ mix('/vendor/fonts/ionicons.css') }}">
	<link rel="stylesheet" href="{{ mix('/vendor/fonts/linearicons.css') }}">
	<link rel="stylesheet" href="{{ mix('/vendor/fonts/open-iconic.css') }}">
	<link rel="stylesheet" href="{{ mix('/vendor/fonts/pe-icon-7-stroke.css') }}">

	<!-- Core stylesheets -->
	<link rel="stylesheet" href="{{ mix('/vendor/css/bootstrap-material.css') }}">
	<link rel="stylesheet" href="{{ mix('/vendor/css/appwork-material.css') }}">
	<link rel="stylesheet" href="{{ mix('/vendor/css/theme-soft-material.css') }}">
	<link rel="stylesheet" href="{{ mix('/vendor/css/colors-material.css') }}">
	<link rel="stylesheet" href="{{ mix('/vendor/css/uikit.css') }}">
	<link rel="stylesheet" href="{{ mix('/css/thotam.css') }}">

	<!-- Load polyfills -->
	<script src="{{ mix('/vendor/js/polyfills.js') }}"></script>
	<script>
	 document['documentMode'] === 10 && document.write('<script src="https://polyfill.io/v3/polyfill.min.js?features=Intl.~locale.en"><\/script>')
	</script>

	<!-- Material ripple -->
	<script src="{{ mix('/vendor/js/material-ripple.js') }}"></script>
	<script>
	 window.attachMaterialRippleOnLoad();
	</script>

	<!-- Layout helpers -->
	<script src="{{ mix('/vendor/js/layout-helpers.js') }}"></script>

	<!-- PACE.js loader -->
	<script src="{{ mix('/vendor/js/pace.js') }}"></script>

	<!-- Libs -->

	<!-- `perfect-scrollbar` library required by SideNav plugin -->
	<link rel="stylesheet" href="{{ mix('/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}">
	<link rel="stylesheet" href="{{ mix('/vendor/libs/spinkit/spinkit.css') }}">
	<link rel="stylesheet" href="{{ mix('/vendor/libs/toastr/toastr.css') }}">

	@yield('styles')
	@stack('styles')

	@livewireStyles

	<!-- Application stylesheets -->
	<link rel="stylesheet" href="{{ mix('/css/application.css') }}">

</head>

<body @yield('bodyclass')>

	<!-- PACE.js loader -->
	<div class="page-loader">
		<div class="bg-primary"></div>
	</div>

	@yield('layout-content')

	<!-- Core scripts -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
	<script src="{{ mix('/vendor/libs/popper/popper.js') }}"></script>
	<script src="{{ mix('/vendor/js/bootstrap.js') }}"></script>
	<script src="{{ mix('/vendor/js/sidenav.js') }}"></script>

	<!-- Libs -->

	<!-- `perfect-scrollbar` library required by SideNav plugin -->
	<script src="{{ mix('/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
	<script src="{{ mix('/vendor/libs/block-ui/block-ui.js') }}"></script>
	<script src="{{ mix('/vendor/libs/toastr/toastr.js') }}"></script>

	@yield('scripts')

	@livewireScripts
	<!-- Application javascripts -->
	<script src="{{ mix('/js/application.js') }}"></script>
	@stack('datatables')
	@stack('scripts')

</body>

</html>
