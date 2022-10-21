<!-- =======================================================
* Template Name: NiceAdmin - v2.4.1
* Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
======================================================== -->

@include('dashboard.header_simple')
@include('dashboard.footer')
@include('dashboard.header_scripts')
@include('dashboard.footer_scripts')

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
    <body class="simple">
        {{-- <div id="site"> --}}
            @yield('header_simple')
            @yield('content')
            @yield('footer')
        {{-- </div> --}}
        @yield('footer_scripts')
    </body>
</html>
