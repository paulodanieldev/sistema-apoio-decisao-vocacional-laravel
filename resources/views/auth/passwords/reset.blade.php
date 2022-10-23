@extends('layouts.auth')
@include('dashboard.alerts')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<main>
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                <div class="d-flex justify-content-center py-4">
                    <a href="{{ route('site') }}" class="logo d-flex align-items-center w-auto">
                    <img src="{{ asset('media/dashboard/logo.png') }}" alt="">
                    <span class="d-none d-lg-block">AVA - Vocacional</span>
                    </a>
                </div><!-- End Logo -->

                <div class="card mb-3">

                    <div class="card-body">
                        <div class="pt-4 pb-2">
                            @yield('alerts')
                            <h5 class="card-title text-center pb-0 fs-4">{{ __('Reset Password') }}</h5>
                            <p class="text-center small">Informe seu e-mail e senha para atualizar</p>
                        </div>
                        <form method="POST" action="{{ route('password.update') }}" class="row g-3 needs-validation" novalidate>
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="col-12">
                                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                    <input type="email" name="email" class="form-control" id="email" value="{{ $email ?? old('email') }}" required autofocus>
                                    <div class="invalid-feedback">Informe seu email.</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input type="password" name="password" class="form-control" id="password" required>
                                <div class="invalid-feedback">Digite uma senha!</div>
                            </div>
                            <div class="col-12">
                                <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                                <div class="invalid-feedback">Digite uma senha!</div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit">{{ __('Reset Password') }}</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="credits">
                    <!-- All the links in the footer should remain intact. -->
                    <!-- You can delete the links only if you purchased the pro version. -->
                    <!-- Licensing information: https://bootstrapmade.com/license/ -->
                    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                    Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                </div>

                </div>
            </div>
            </div>

        </section>

    </div>
</main><!-- End #main -->
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
@endsection
