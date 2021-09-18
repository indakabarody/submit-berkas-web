
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <title>{{ config('app.name') }}</title>
        {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
        {{-- <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" /> --}}
        {{-- <meta content="Coderthemes" name="author" /> --}}
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        {{-- App favicon --}}
        {{-- <link rel="shortcut icon" href="{{asset('themes/guest/images/favicon.ico')}}"> --}}

        {{-- Bootstrap core CSS --}}
        <link rel="stylesheet" href="{{asset('themes/guest/css/bootstrap.min.css')}}" type="text/css">

        {{--Material Icon --}}
        <link rel="stylesheet" type="text/css" href="{{asset('themes/guest/css/materialdesignicons.min.css')}}" />

        {{-- Custom  sCss --}}
        <link rel="stylesheet" type="text/css" href="{{asset('themes/guest/css/style.css')}}" />

    </head>

    <body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="78">

        {{--Navbar Start--}}
        <nav class="navbar navbar-expand-lg fixed-top navbar-custom sticky-dark" id="sticky">
            <div class="container-fluid">
                {{-- LOGO --}}
                {{-- <a class="logo text-uppercase" href="index.html">
                    <img src="{{asset('themes/guest/images/logo-light.png')}}" alt="" class="logo-light" height="21" />
                    <img src="{{asset('themes/guest/images/logo-dark.png')}}" alt="" class="logo-dark" height="21" />
                </a> --}}

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="mdi mdi-menu"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mx-auto navbar-center" id="mySidenav">
                        {{-- <li class="nav-item">
                            <a href="#home" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="#features" class="nav-link">Features</a>
                        </li>
                        <li class="nav-item">
                            <a href="#demo" class="nav-link">Demos</a>
                        </li>
                        <li class="nav-item">
                            <a href="#pricing" class="nav-link">Pricing</a>
                        </li>
                        <li class="nav-item">
                            <a href="#faq" class="nav-link">Faqs</a>
                        </li>
                        <li class="nav-item">
                            <a href="#clients" class="nav-link">Clients</a>
                        </li>
                        <li class="nav-item">
                            <a href="#contact" class="nav-link">Contact</a>
                        </li> --}}
                    </ul>
                    <a href="{{ route('member.login') }}" class="btn btn-info navbar-btn">Login Member</a>
                </div>
            </div>
        </nav>
        {{-- Navbar End --}}

        {{-- home start --}}
        <section class="bg-home bg-gradient" id="home">
            <div class="home-center">
                <div class="home-desc-center">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <div class="home-title mo-mb-20">
                                    <h1 class="mb-4 text-white">Selamat Datang!</h1>
                                    <p class="text-white-50 home-desc mb-5">Silakan Anda bergabung menjadi member kami, dan dapatkan manfaat - manfaat menjadi member!</p>
                                    <div class="subscribe">
                                        <form>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <a href="{{ route('member.register') }}" class="btn btn-primary">Gabung Sekarang</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-xl-4 offset-xl-2 col-lg-5 offset-lg-1 col-md-7">
                                <div class="home-img position-relative">
                                    <img src="{{asset('themes/guest/images/home-img.png')}}" alt="" class="home-first-img">
                                    <img src="{{asset('themes/guest/images/home-img.png')}}" alt="" class="home-second-img mx-auto d-block">
                                    <img src="{{asset('themes/guest/images/home-img.png')}}" alt="" class="home-third-img">
                                </div>
                            </div> --}}
                        </div>
                        {{-- end row --}}
                    </div>
                    {{-- end container-fluid --}}
                </div>
            </div>
        </section>
        {{-- home end --}}

        {{-- footer start --}}
        <footer class="bg-dark footer">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="float-start pull-none">
                            <p class="text-white-50">&copy; {{ date('Y') }} The Journalish</p>
                        </div>
                    </div>
                    {{-- end col --}}
                </div>
                {{-- end row --}}
            </div>
            {{-- container-fluid --}}
        </footer>
        {{-- footer end --}}

        {{-- Back to top --}}
        {{-- <a href="#" class="back-to-top" id="back-to-top"> <i class="mdi mdi-chevron-up"> </i> </a> --}}
        {{-- Back to top --}}
        <a href="#" onclick="topFunction()" class="back-to-top-btn btn btn-primary" id="back-to-top-btn"><i class="mdi mdi-chevron-up"></i></a>

        {{-- javascript --}}

        <script src="{{asset('themes/guest/js/bootstrap.bundle.min.js')}}"></script>

        {{-- custom js --}}
        <script src="{{asset('themes/guest/js/app.js')}}"></script>
    </body>

</html>
