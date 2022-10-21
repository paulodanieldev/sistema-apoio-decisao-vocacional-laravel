<!-- =======================================================
* Template Name: KnightOne - v4.9.1
* Template URL: https://bootstrapmade.com/knight-simple-one-page-bootstrap-template/
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
======================================================== -->

@include('site.header')
@include('site.footer')
@include('site.header_scripts')
@include('site.footer_scripts')
@include('site.content')

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
    <body>
        {{-- <div id="site"> --}}
            @yield('header')
            @yield('content')
            @yield('footer')
        {{-- </div> --}}
        @yield('footer_scripts')
    </body>
</html>
