<?php $routeName = Route::currentRouteName(); ?>
@php
$home_hr = Auth::user()?->hr;
@endphp

<div id="layout-sidenav" class="{{ isset($layout_sidenav_horizontal) ? 'layout-sidenav-horizontal sidenav-horizontal container-p-x flex-grow-0' : 'layout-sidenav sidenav-vertical' }} sidenav bg-dark">

	@empty($layout_sidenav_horizontal)
		<!-- Brand demo (see assets/css/demo/demo.css) -->
		<div class="app-brand demo">
			<span class="app-brand-logo demo bg-white">
				@include('layouts.includes.sub.logo')
			</span>
			<span class="app-brand-text demo sidenav-text font-weight-normal ml-2">TQC Member</span>
			<a href="javascript:void(0)" class="layout-sidenav-toggle sidenav-link text-large ml-auto">
				<i class="ion ion-md-menu align-middle"></i>
			</a>
		</div>

		<div class="sidenav-divider mt-0"></div>
	@endempty

	<!-- Inner -->
	<ul class="sidenav-inner{{ empty($layout_sidenav_horizontal) ? ' py-1 pb-5 pb-md-1' : 'pb-5 pb-md-0' }}">

		<li class="sidenav-item{{ $routeName == 'home' ? ' active' : '' }}">
			<a href="{{ route('home') }}" class="sidenav-link"><i class="sidenav-icon fas fa-home d-block"></i>
				<div>Trang chủ</div>
			</a>
		</li>

		<li class="sidenav-item{{ $routeName == 'page-2' ? ' active' : '' }}">
			<a href="{{ route('page-2') }}" class="sidenav-link"><i class="sidenav-icon ion ion-md-desktop"></i>
				<div>Page 2</div>
			</a>
		</li>

	</ul>
</div>
