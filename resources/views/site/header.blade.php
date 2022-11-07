@section('header')
    <header id="header" class="fixed-top ">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-9 d-flex align-items-center justify-content-lg-between">
                <h1 class="logo me-auto me-lg-0"><a href="{{ route('site') }}"><img src="{{ asset('media/dashboard/logo.png') }}" alt="logo" class="img-fluid"> AVA - Vocacional</a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html" class="logo me-auto me-lg-0"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

                <nav id="navbar" class="navbar order-last order-lg-0">
                    <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#about">Sobre</a></li>
                    {{-- <li><a class="nav-link scrollto" href="#services">Services</a></li> --}}
                    <li><a class="nav-link scrollto" href="#features">Atualizações</a></li>
                    {{-- <li><a class="nav-link scrollto " href="#portfolio">Portfolio</a></li> --}}
                    {{-- <li><a class="nav-link scrollto" href="#pricing">Pricing</a></li> --}}
                    {{-- <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                        <li><a href="#">Drop Down 1</a></li>
                        <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                            <ul>
                            <li><a href="#">Deep Drop Down 1</a></li>
                            <li><a href="#">Deep Drop Down 2</a></li>
                            <li><a href="#">Deep Drop Down 3</a></li>
                            <li><a href="#">Deep Drop Down 4</a></li>
                            <li><a href="#">Deep Drop Down 5</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Drop Down 2</a></li>
                        <li><a href="#">Drop Down 3</a></li>
                        <li><a href="#">Drop Down 4</a></li>
                        </ul>
                    </li> --}}
                    {{-- <li><a class="nav-link scrollto" href="#contact">Contact</a></li> --}}
                    </ul>
                    <i class="bi bi-list mobile-nav-toggle"></i>
                </nav><!-- .navbar -->

                @if (Route::has('login'))
                    <div class="navbar order-last order-lg-0">
                        @auth
                            <a href="{{ url('/home') }}" class="get-started-btn">Dashboard</a>
                        @else
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class=" nav-link scrollto">Criar conta</a>
                            @endif
                            <a href="{{ route('login') }}" class="get-started-btn scrollto">Entrar</a>
                        @endauth
                    </div>
                @endif
                </div>
            </div>
        </div>
    </header><!-- End Header -->
@endsection