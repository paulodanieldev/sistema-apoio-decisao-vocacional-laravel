@section('footer_scripts')
    <!-- ======= Footer Scripts ======= -->
    <!-- Vendor JS Files -->
    {{-- <script src="assets/vendor/php-email-form/validate.js"></script> --}}

    <!-- Template Main JS File -->
    <script src="{{ asset('js/site/site.js?v=' . env('ASSETS_VERSION', '1.0')) }}" defer></script>

    <!-- End Footer Scripts -->
@endsection