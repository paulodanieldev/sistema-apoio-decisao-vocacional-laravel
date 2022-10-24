@extends('layouts.auth')
@include('dashboard.alerts')

@section('content')
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
                        <h5 class="card-title text-center pb-0 fs-4">Acessar sua conta</h5>
                        <p class="text-center small">Entre com suas informações de email e senha</p>
                    </div>
                    <form method="POST" action="{{ route('login') }}" class="row g-3 needs-validation" novalidate>
                        @csrf
                        <div class="col-12">
                            <label for="email" class="form-label">E-mail</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                <input type="email" name="email" class="form-control" id="email" required>
                                <div class="invalid-feedback">Digite seu email.</div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="password" class="form-label">Senha</label>
                            <input type="password" name="password" class="form-control" id="password" required>
                            <div class="invalid-feedback">Digite sua senha</div>
                        </div>

                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" value="true" id="remember">
                                <label class="form-check-label" for="remember">Lembrar informações</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100" type="submit">Entrar</button>
                        </div>
                        <div class="col-12">
                            <p class="small mb-0">Ainda não tem uma conta? <a href="{{ route('register') }}">Criar uma conta.</a></p>
                        </div>
                        @if (Route::has('password.request'))
                            <div class="col-12">
                                <p class="small mb-0">Esqueceu sua senha? <a href="{{ route('password.request') }}">Recuperar senha.</a></p>
                            </div>
                        @endif
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
