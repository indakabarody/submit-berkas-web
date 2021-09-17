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

		{{-- App css --}}
		<link href="{{asset('themes/user/css/config/default/bootstrap.min.css')}}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
		<link href="{{asset('themes/user/css/config/default/app.min.css')}}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

		<link href="{{asset('themes/user/css/config/default/bootstrap-dark.min.css')}}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
		<link href="{{asset('themes/user/css/config/default/app-dark.min.css')}}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

		{{-- icons --}}
		<link href="{{asset('themes/user/css/icons.min.css')}}" rel="stylesheet" type="text/css" />

    </head>

    <body class="loading auth-fluid-pages pb-0">

        <div class="auth-fluid">
            {{--Auth fluid left content --}}
            <div class="auth-fluid-form-box">
                <div class="align-items-center d-flex h-100">
                    <div class="card-body">

                    @yield('content')

                    </div> {{-- end .card-body --}}
                </div> {{-- end .align-items-center.d-flex.h-100--}}
            </div>
            {{-- end auth-fluid-form-box--}}

            {{-- Auth fluid right content --}}
            <div class="auth-fluid-right text-center">
                <div class="auth-user-testimonial">
                    <h2 class="mb-3 text-white">Selamat Datang!</h2>
                    {{-- <p class="lead"><i class="mdi mdi-format-quote-open"></i> I've been using your theme from the previous developer for our web app, once I knew new version is out, I immediately bought with no hesitation. Great themes, good documentation with lots of customization available and sample app that really fit our need. <i class="mdi mdi-format-quote-close"></i>
                    </p>
                    <h5 class="text-white">
                        - Fadlisaad (Ubold Admin User)
                    </h5> --}}
                </div> {{-- end auth-user-testimonial--}}
            </div>
            {{-- end Auth fluid right content --}}
        </div>
        {{-- end auth-fluid--}}

        {{-- Vendor js --}}
        <script src="{{asset('themes/user/js/vendor.min.js')}}"></script>

        {{-- App js --}}
        <script src="{{asset('themes/user/js/app.min.js')}}"></script>

    </body>
</html>
