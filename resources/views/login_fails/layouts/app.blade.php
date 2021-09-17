<!DOCTYPE html>
<html lang="en">
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
		<link href="{{asset('themes/user/css/icons.min.css" rel="stylesheet')}}" type="text/css" />

    </head>

    <body class="loading authentication-bg">

        <div class="mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-11">

                        <div class="text-center">
                            <svg id="Layer_1" class="svg-computer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 424.2 424.2">
                                <style>
                                    .st0{fill:none;stroke: #ffffff;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;}
                                </style>
                                <g id="Layer_2">
                                    <path class="st0" d="M339.7 289h-323c-2.8 0-5-2.2-5-5V55.5c0-2.8 2.2-5 5-5h323c2.8 0 5 2.2 5 5V284c0 2.7-2.2 5-5 5z"/>
                                    <path class="st0" d="M26.1 64.9h304.6v189.6H26.1zM137.9 288.5l-3.2 33.5h92.6l-4.4-33M56.1 332.6h244.5l24.3 41.1H34.5zM340.7 373.7s-.6-29.8 35.9-30.2c36.5-.4 35.9 30.2 35.9 30.2h-71.8z"/>
                                    <path class="st0" d="M114.2 82.8v153.3h147V82.8zM261.2 91.1h-147"/>
                                    <path class="st0" d="M124.5 105.7h61.8v38.7h-61.8zM196.6 170.2H249v51.7h-52.4zM196.6 105.7H249M196.6 118.6H249M196.6 131.5H249M196.6 144.4H249M124.5 157.3H249M124.5 170.2h62.2M124.5 183.2h62.2M124.5 196.1h62.2M124.5 209h62.2M124.5 221.9h62.2"/>
                                </g>
                            </svg>
                            <h3 class="mt-4 text-white">@yield('title')</h3>
                            <p class="text-white-50">@yield('message')</p>
                        </div> {{-- end /.text-center--}}

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


        {{-- App js --}}
        <script src="{{asset('themes/user/js/vendor.min.js')}}"></script>
        <script src="{{asset('themes/user/js/app.min.js')}}"></script>

    </body>
</html>
