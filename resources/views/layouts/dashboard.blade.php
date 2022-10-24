<!-- =======================================================
* Template Name: NiceAdmin - v2.4.1
* Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
======================================================== -->

@include('dashboard.header')
@include('dashboard.footer')
@include('dashboard.header_scripts')
@include('dashboard.footer_scripts')
@include('dashboard.sidebar.user_sidebar')
@include('dashboard.sidebar.admin_sidebar')

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta content="" name="description">
        <meta content="" name="keywords">

        @yield('header_scripts')
    </head>
    <body >
        <div id="loader"></div>
        <div id="site-dashboard">
            @yield('header')

            @switch(Auth::user()->account_type)
                @case(App\Constants\AccountTypePrefixConstants::ADMIN)
                    @yield('admin_sidebar')
                    @break
                @default
                    @yield('user_sidebar')
            @endswitch

            @yield('content')
            @yield('footer')
        </div>
        @yield('footer_scripts')
    </body>

</html>
