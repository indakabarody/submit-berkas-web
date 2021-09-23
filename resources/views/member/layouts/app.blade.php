<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8" />
		<title>@yield('title') - {{ config('app.name') }}</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		{{-- <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" /> --}}
		{{-- <meta content="Coderthemes" name="author" /> --}}
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		{{-- App favicon --}}
		{{-- <link rel="shortcut icon" href="{{asset('themes/user/images/favicon.ico')}}"> --}}
        {{-- third party css --}}
        @yield('page_styles')
        {{-- third party css end --}}
		{{-- App css --}}
		<link href="{{asset('themes/user/css/config/default/bootstrap.min.css')}}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
		<link href="{{asset('themes/user/css/config/default/app.min.css')}}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
		<link href="{{asset('themes/user/css/config/default/bootstrap-dark.min.css')}}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
		<link href="{{asset('themes/user/css/config/default/app-dark.min.css')}}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />
		{{-- icons --}}
		<link href="{{asset('themes/user/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
	</head>
	{{-- body start --}}
	<body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "light"}, "showRightSidebarOnPageLoad": true}'>
		{{-- Begin page --}}
		<div id="wrapper">
			{{-- Topbar Start --}}
			<div class="navbar-custom">
				<div class="container-fluid">
					<ul class="list-unstyled topnav-menu float-end mb-0">
                        <li class="dropdown notification-list topbar-dropdown">
                            @php
                                $announcements = App\Models\Announcement::where('member_id', Auth::user()->id)
                                            ->whereNull('read_at')
                                            ->get();
                                $totalAnno = count($announcements);
                            @endphp
                            <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="fe-bell noti-icon"></i>
                                @if ($totalAnno > 0)
                                <span class="badge bg-danger rounded-circle noti-icon-badge">{{ $totalAnno }}</span>
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-lg">

                                {{-- item--}}
                                <div class="dropdown-item noti-title">
                                    <h5 class="m-0">
                                        Pengumuman Baru
                                    </h5>
                                </div>

                                <div class="noti-scroll" data-simplebar>


                                    @foreach ($announcements as $announcement)
                                        {{-- item--}}
                                        <a href="{{ route('member.announcements.show', $announcement->id) }}" class="dropdown-item notify-item">
                                            <div class="notify-icon bg-primary">
                                                <i class="mdi mdi-comment-account-outline"></i>
                                            </div>
                                            <p class="notify-details">{{ $announcement->title }}
                                                <small class="text-muted">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($announcement->created_at))->diffForHumans() }}</small>
                                            </p>
                                        </a>
                                    @endforeach


                                </div>

                                {{-- All--}}
                                <a href="{{ route('member.announcements.index') }}" class="dropdown-item text-center text-primary notify-item notify-all">
                                    Lihat semua
                                    <i class="fe-arrow-right"></i>
                                </a>

                            </div>
                        </li>
						<li class="dropdown notification-list topbar-dropdown">
							<a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
							<img src="@isset(Auth::user()->image) {{ asset('storage/member/images/'.Auth::user()->id.'/'.Auth::user()->image) }} @else {{ asset('themes/user/images/users/blank.png') }} @endisset" alt="user-image" class="rounded-circle">
							<span class="pro-user-name ms-1">
							{{ Auth::user()->name }} <i class="mdi mdi-chevron-down"></i>
							</span>
							</a>
							<div class="dropdown-menu dropdown-menu-end profile-dropdown ">
								{{-- item--}}
								<div class="dropdown-header noti-title">
									<h6 class="text-overflow m-0">Selamat Datang !</h6>
								</div>
								{{-- item--}}
								<a href="{{ route('member.edit-profile') }}" class="dropdown-item notify-item">
								<i class="fe-user"></i>
								<span>Profil Saya</span>
								</a>
								{{-- item--}}
								<a href="{{ route('member.change-password') }}" class="dropdown-item notify-item">
								<i class="fe-settings"></i>
								<span>Ganti Password</span>
								</a>
								<div class="dropdown-divider"></div>
								{{-- item--}}
								<a href="javascript:void(0);" class="dropdown-item notify-item" data-bs-toggle="modal" data-bs-target="#logoutModal">
								<i class="fe-log-out"></i>
								<span>Logout</span>
								</a>
							</div>
						</li>
					</ul>
					{{-- LOGO --}}
					<div class="logo-box">
						<a href="{{ route('member.dashboard') }}" class="logo logo-dark text-center">
						<span class="logo-sm">
						<img src="{{asset('logos/logo-sm.png')}}" alt="" height="22">
						{{-- <span class="logo-lg-text-light">Submit Naskah</span> --}}
						</span>
						<span class="logo-lg">
						<img src="{{asset('logos/logo-dark.png')}}" alt="" height="50">
						{{-- <span class="logo-lg-text-light">SN</span> --}}
						</span>
						</a>
						<a href="{{ route('member.dashboard') }}" class="logo logo-light text-center">
						<span class="logo-sm">
						<img src="{{asset('logos/logo-sm.png')}}" alt="" height="22">
						{{-- <span class="logo-lg-text-light">SN</span> --}}
						</span>
						<span class="logo-lg">
						<img src="{{asset('themes/user/images/logo-light.png')}}" alt="" height="20">
						{{-- <span class="logo-lg-text-light">Submit Naskah</span> --}}
						</span>
						</a>
					</div>
					<ul class="list-unstyled topnav-menu topnav-menu-left m-0">
						<li>
							<button class="button-menu-mobile waves-effect waves-light">
							<i class="fe-menu"></i>
							</button>
						</li>
						<li>
							{{-- Mobile menu toggle (Horizontal Layout)--}}
							<a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
								<div class="lines">
									<span></span>
									<span></span>
									<span></span>
								</div>
							</a>
							{{-- End mobile menu toggle--}}
						</li>
					</ul>
					<div class="clearfix"></div>
				</div>
			</div>
			{{-- end Topbar --}}
			{{-- ========== Left Sidebar Start ========== --}}
			<div class="left-side-menu">
				<div class="h-100" data-simplebar>
					{{--- Sidemenu --}}
					<div id="sidebar-menu">
						<ul id="side-menu">
							<li>
								<a href="{{ route('member.dashboard') }}">
								<i data-feather="airplay"></i>
								<span> Dashboard </span>
								</a>
							</li>
							<li class="menu-title mt-2">Menu Member</li>
							<li>
								<a href="#sidebarScripts" data-bs-toggle="collapse">
								<i data-feather="file-text"></i>
								<span> Naskah Saya </span>
								<span class="menu-arrow"></span>
								</a>
								<div class="collapse" id="sidebarScripts">
									<ul class="nav-second-level">
										<li>
											<a href="{{ route('member.scripts.index') }}">Semua Naskah</a>
										</li>
										<li>
											<a href="{{ route('member.processed-scripts') }}">Naskah Proses Review</a>
										</li>
										<li>
											<a href="{{ route('member.done-scripts') }}">Naskah Selesai</a>
										</li>
									</ul>
								</div>
							</li>
                            <li>
								<a href="{{ route('member.announcements.index') }}">
								<i data-feather="info"></i>
								<span> Pengumuman </span>
                                @if ($totalAnno > 0)
                                <span class="badge bg-success rounded-pill float-end">{{ $totalAnno }}</span>
                                @endif
								</a>
							</li>
                            <li>
								<a href="{{ route('member.guides.index') }}">
								<i data-feather="align-justify"></i>
								<span> Panduan </span>
								</a>
							</li>
                            <li>
								<a href="{{ route('member.chats.index') }}">
								<i data-feather="mail"></i>
								<span> Hubungi Admin </span>
								</a>
							</li>
						</ul>
					</div>
					{{-- End Sidebar --}}
					<div class="clearfix"></div>
				</div>
				{{-- Sidebar -left --}}
			</div>
			{{-- Left Sidebar End --}}
			{{-- ============================================================== --}}
			{{-- Start Page Content here --}}
			{{-- ============================================================== --}}
			<div class="content-page">
				@yield('content')
				{{-- Footer Start --}}
				<footer class="footer">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-6">
								&copy; {{ date('Y') }} <a href="https://thejournalish.com">The Journalish</a>
							</div>
							{{--
							<div class="col-md-6">
								<div class="text-md-end footer-links d-none d-sm-block">
									<a href="javascript:void(0);">About Us</a>
									<a href="javascript:void(0);">Help</a>
									<a href="javascript:void(0);">Contact Us</a>
								</div>
							</div>
							--}}
						</div>
					</div>
				</footer>
				{{-- end Footer --}}
			</div>
			{{-- ============================================================== --}}
			{{-- End Page content --}}
			{{-- ============================================================== --}}
		</div>
		{{-- END wrapper --}}

		{{-- Logout Modal --}}
		<div class="modal fade" id="logoutModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Log Out</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
                        Yakin ingin log out?
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
						<button type="button" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn btn-primary">Ya</button>
					</div>
				</div>
			</div>
		</div>
        <form id="logout-form" action="{{ route('member.logout') }}" method="POST" class="d-none">
            @csrf
        </form>
		{{-- Vendor js --}}
		<script src="{{asset('themes/user/js/vendor.min.js')}}"></script>
        {{-- third party js --}}
        @yield('page_scripts')
        {{-- third party js ends --}}
		{{-- App js --}}
		<script src="{{asset('themes/user/js/app.min.js')}}"></script>
	</body>
</html>
