
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <title>@yield('title') - {{ config('app.name') }}</title>
        {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
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

    <body class="loading authentication-bg authentication-bg-pattern">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-4">

                        @yield('content')

                    </div> {{-- end col --}}
                </div>
                {{-- end row --}}
            </div>
            {{-- end container --}}
        </div>
        {{-- end page --}}


        <footer class="footer footer-alt">
            &copy; {{ date('Y') }} <a href="https://thejournalish.com" class="text-white-50">The Journalish</a>
        </footer>

        {{-- Vendor js --}}
        <script src="{{asset('themes/user/js/vendor.min.js')}}"></script>

        {{-- App js --}}
        <script src="{{asset('themes/user/js/app.min.js')}}"></script>

    </body>
</html>
