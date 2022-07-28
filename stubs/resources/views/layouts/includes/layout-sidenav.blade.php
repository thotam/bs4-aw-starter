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

		<!-- Admin -->
		@if ($home_hr->hasAnyRole(['super-admin', 'admin', 'admin-product']))
			<li class="sidenav-item{{ strpos($routeName, 'admin.') === 0 ? ' active open' : '' }}">
				<a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon fas fa-users-cog d-block"></i>
					<div>Admin</div>
				</a>

				<ul class="sidenav-menu">
					@if ($home_hr->hasAnyRole(['super-admin', 'admin']))
						<li class="sidenav-item{{ strpos($routeName, 'admin.member.') === 0 ? ' active open' : '' }}">
							<a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon fas fa-user-friends d-block"></i>
								<div>Thành viên</div>
							</a>

							<ul class="sidenav-menu">

								<li class="sidenav-item{{ $routeName == 'admin.member.user' ? ' active' : '' }}">
									<a href="{{ route('admin.member.user') }}" class="sidenav-link"><i class="sidenav-icon far fa-user-circle d-block"></i>
										<div>Tài khoản</div>
									</a>
								</li>

								<li class="sidenav-item{{ $routeName == 'admin.member.hr' ? ' active' : '' }}">
									<a href="{{ route('admin.member.hr') }}" class="sidenav-link"><i class="sidenav-icon fas fa-user-lock d-block"></i>
										<div>Nhân sự</div>
									</a>
								</li>

								<li class="sidenav-item{{ $routeName == 'admin.member.team' ? ' active' : '' }}">
									<a href="{{ route('admin.member.team') }}" class="sidenav-link"><i class="sidenav-icon fas fa-users d-block"></i>
										<div>Nhóm</div>
									</a>
								</li>

							</ul>

						</li>

						<li class="sidenav-item{{ $routeName == 'admin.role' ? ' active' : '' }}">
							<a href="{{ route('admin.role') }}" class="sidenav-link"><i class="sidenav-icon fas fas fa-user-tag d-block"></i>
								<div>Phân quyền</div>
							</a>
						</li>
					@endif

					@if ($home_hr->hasAnyRole(['super-admin', 'admin', 'admin-chinhanh']))
						<!-- Admin Chi nhánh -->
						<li class="sidenav-item{{ $routeName == 'admin.chinhanh' ? ' active' : '' }}">
							<a href="{{ route('admin.chinhanh') }}" class="sidenav-link pr-1"><i class="sidenav-icon fa-solid fa-code-branch d-block"></i>
								<div>Chi nhánh</div>
							</a>
						</li>
					@endif

				</ul>
			</li>
		@endif

		<li class="sidenav-item{{ strpos($routeName, 'khachhang.') === 0 ? ' active open' : '' }}">
			<a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon fas fa-users-cog d-block"></i>
				<div>Khách hàng</div>
			</a>

			<ul class="sidenav-menu">
				<li class="sidenav-item{{ $routeName == 'khachhang.khachhang' ? ' active' : '' }}">
					<a href="{{ route('khachhang.khachhang') }}" class="sidenav-link pr-1"><i class="sidenav-icon fa-solid fa-id-card d-block"></i>
						<div>Danh sách</div>
					</a>
				</li>

				<li class="sidenav-item{{ $routeName == 'khachhang.phanbo' ? ' active' : '' }}">
					<a href="{{ route('khachhang.phanbo') }}" class="sidenav-link pr-1"><i class="sidenav-icon fa-solid fa-ballot-check d-block"></i>
						<div>Phân bổ</div>
					</a>
				</li>

				<li class="sidenav-item{{ $routeName == 'khachhang.baocao' ? ' active' : '' }}">
					<a href="{{ route('khachhang.baocao') }}" class="sidenav-link pr-1"><i class="sidenav-icon fa-solid fa-file-arrow-up d-block"></i>
						<div>Báo cáo</div>
					</a>
				</li>
			</ul>

		</li>

	</ul>
</div>
