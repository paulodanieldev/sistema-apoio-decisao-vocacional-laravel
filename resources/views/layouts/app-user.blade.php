<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <script>
        window.base = "{{ url('/') }}/";
    </script>

    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    {{-- <link rel="stylesheet" href="{{ asset('font/iconsmind-s/css/iconsminds.css') }}" /> --}}
    {{-- <link rel="stylesheet" href="{{ asset('font/simple-line-icons/css/simple-line-icons.css') }}" /> --}}

    {{-- <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.min.css') }}" /> --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.rtl.only.min.css') }}" /> --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/vendor/component-custom-switch.min.css') }}" /> --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/vendor/perfect-scrollbar.css') }}" /> --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/main.css') }}" /> --}}

    {{-- <link rel="stylesheet" href="{{ asset('css/vendor/dataTables.bootstrap4.min.css') }}" /> --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/vendor/datatables.responsive.bootstrap4.min.css') }}" /> --}}

    {{-- <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap-float-label.min.css') }}" /> --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/vendor/select2.min.css') }}" /> --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/vendor/select2-bootstrap.min.css') }}" /> --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap-datepicker3.min.css') }}" /> --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap-tagsinput.css') }}" /> --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/jquery-confirm.min.css') }}" /> --}}

    {{-- <link rel="stylesheet" href="{{ asset('css/vendor/fullcalendar.min.css') }}" /> --}}

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" integrity="sha512-H9jrZiiopUdsLpg94A333EfumgUBpO9MdbxStdeITo+KEIMaNfHNvwyjjDJb+ERPaRS6DpyRlKbvPUasNItRyw==" crossorigin="anonymous" /> --}}

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css" integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w==" crossorigin="anonymous" /> --}}
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body id="app-container" class="menu-default show-spinner">
<nav class="navbar fixed-top">
    <div class="d-flex align-items-center navbar-left">
        <a href="#" class="menu-button d-none d-md-block">
            <svg class="main" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9 17">
                <rect x="0.48" y="0.5" width="7" height="1" />
                <rect x="0.48" y="7.5" width="7" height="1" />
                <rect x="0.48" y="15.5" width="7" height="1" />
            </svg>
            <svg class="sub" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17">
                <rect x="1.56" y="0.5" width="16" height="1" />
                <rect x="1.56" y="7.5" width="16" height="1" />
                <rect x="1.56" y="15.5" width="16" height="1" />
            </svg>
        </a>

        <a href="#" class="menu-button-mobile d-xs-block d-sm-block d-md-none">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 17">
                <rect x="0.5" y="0.5" width="25" height="1" />
                <rect x="0.5" y="7.5" width="25" height="1" />
                <rect x="0.5" y="15.5" width="25" height="1" />
            </svg>
        </a>

    </div>


    <a class="navbar-logo" href="{{ url('/user/dashboard') }}">
        <span class="logo d-none d-xs-block"></span>
        <span class="logo-mobile d-block d-xs-none"></span>
    </a>

    <div class="navbar-right">
        <div class="header-icons d-inline-block align-middle">
            <div class="d-none d-md-inline-block align-text-bottom mr-3">
                <div class="custom-switch custom-switch-primary-inverse custom-switch-small pl-1"
                     data-toggle="tooltip" data-placement="left" title="Tema escuro">
                    <input class="custom-switch-input" id="switchDark" type="checkbox" checked>
                    <label class="custom-switch-btn" for="switchDark"></label>
                </div>
            </div>

            <div class="position-relative d-inline-block">
                <button class="header-icon btn btn-empty" type="button" id="notificationButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="simple-icon-bell"></i>
                    <span class="count">0</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right mt-3 position-absolute" id="notificationDropdown">
                    <div class="scroll">
                        <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                            <a href="#">
                                <img src="{{ asset('img/profiles/l-2.jpg') }}" alt="Notification Image"
                                     class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle" />
                            </a>
                            <div class="pl-3">
                                <a href="#">
                                    <p class="font-weight-medium mb-1">Nenhuma mensagem</p>
                                    <p class="text-muted mb-0 text-small">{{ date('d/m/Y') }}</p>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="user d-inline-block">
            <button class="header-icon btn btn-empty d-sm-inline-block"  type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="simple-icon-user"></i>
                <span class="name">{{ Auth::user()->name }}</span>
                <i class="simple-icon-arrow-down" style="font-size:10px"></i>
            </button>

            <div class="dropdown-menu dropdown-menu-right mt-3">
                <a class="dropdown-item" href="#">Minha conta</a>
                <a class="dropdown-item" href="{{ url('/logout') }}">Logout</a>
            </div>
        </div>
    </div>
</nav>

@include('layouts.menu-user')
<main>
    @yield('content')
</main>

<footer class="page-footer">
    <div class="footer-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <p class="mb-0 text-muted">Copyright &#169; Paulo dias</p>
                </div>
                <div class="col-sm-6 d-none d-sm-block">
                    <ul class="breadcrumb pt-0 pr-0 float-right">
                        <li class="breadcrumb-item mb-0">
                            <a href="#" class="btn-link">Docs</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

{{-- <script src="{{ asset('js/vendor/jquery-3.3.1.min.js') }}"></script> --}}
{{-- <script src="{{ asset('js/vendor/bootstrap.bundle.min.js') }}"></script> --}}
{{-- <script src="{{ asset('js/vendor/perfect-scrollbar.min.js') }}"></script> --}}
{{-- <script src="{{ asset('js/vendor/mousetrap.min.js') }}"></script> --}}

{{-- <script src="{{ asset('js/vendor/datatables.min.js') }}"></script> --}}

{{-- <script src="{{ asset('js/vendor/moment.min.js') }}"></script> --}}
{{-- <script src="{{ asset('js/vendor/fullcalendar.min.js') }}"></script> --}}
{{-- <script src="{{ asset('js/vendor/locale/pt-br.min.js') }}"></script> --}}

{{-- <script src="{{ asset('js/dore.script.js') }}"></script> --}}
{{-- <script src="{{ asset('js/scripts.js') }}"></script> --}}
{{-- <script src="{{ asset('js/jquery.mask.js') }}"></script> --}}
{{-- <script src="{{ asset('js/jquery-confirm.min.js') }}"></script> --}}

{{-- <script src="{{ asset('js/vendor/select2.full.js') }}"></script> --}}

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script> --}}

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous"></script> --}}

{{-- <script src="{{ asset('js/gauge.min.js') }}"></script> --}}

{{-- <script src="{{ asset('js/avaliacao_visita.js') }}" defer></script> --}}
{{-- <script src="{{ asset('js/passos_score_dashboard.js') }}" defer></script> --}}
{{-- <script src="{{ asset('js/avaliacao_dashboard.js') }}" defer></script> --}}

{{-- @yield('scripts') --}}
<script src="{{ asset('js/app.js') }}" defer></script>
</body>

</html>
