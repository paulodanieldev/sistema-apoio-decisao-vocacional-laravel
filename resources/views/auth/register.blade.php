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
                                    <h5 class="card-title text-center pb-0 fs-4">Criar uma conta</h5>
                                    <p class="text-center small">Entre com suas informações para criar uma conta</p>
                                </div>
                                <form method="POST" action="{{ route('register') }}" class="row g-3 needs-validation" novalidate>
                                    @csrf
                                    <div class="col-12">
                                        <label for="yourName" class="form-label">Your Name</label>
                                        <input type="text" name="name" class="form-control" id="yourName" required>
                                        <div class="invalid-feedback">Informe o seu nome!</div>
                                    </div>
                                    <div class="col-12">
                                        <label for="yourEmail" class="form-label">Seu email</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                            <input type="email" name="email" class="form-control" id="yourEmail" required>
                                            <div class="invalid-feedback">Informe um email válido!</div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Senha</label>
                                        <input type="password" name="password" class="form-control" id="yourPassword" required>
                                        <div class="invalid-feedback">Informe uma senha!</div>
                                    </div>
                                    <div class="col-12">
                                        <label for="yourConfirmPassword" class="form-label">Confirme sua senha</label>
                                        <input type="password" name="password_confirmation" class="form-control" id="yourConfirmPassword" required>
                                        <div class="invalid-feedback">Informe sua senha novamente!</div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                                            <label class="form-check-label" for="acceptTerms">Eu aceito com os <a href="#">termos e condições</a></label>
                                            <div class="invalid-feedback">Você precisa aceitar para continuar.</div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Criar conta</button>
                                    </div>
                                    <div class="col-12">
                                        <p class="small mb-0">Já possui uma conta? <a href="{{ route('login') }}">Acessar conta</a></p>
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
