@extends('layouts.dashboard')

@include('dashboard.alerts')

@section('content')

    <main id="main" class="main">
        @yield('alerts')

        <!-- ======= Page Title ======= -->
        <div class="pagetitle">
            <h1>Usuários</h1>
            <nav>
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('admin.users.index') }}">Usuários</a></li>
                <li class="breadcrumb-item active">Novo</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section users">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card pt-3">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Novo usuário</h5>

                            <!-- Floating Labels Form -->
                            <form class="row g-3" action="{{ route('admin.users.store') }}" method="POST">
                                @csrf
                                @method('POST')

                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" placeholder="" name="name" required value="{{ old('name') }}">
                                        <label for="name">Nome</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" placeholder="" name="email" required value="{{ old('email') }}">
                                        <label for="email">E-mail</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="account_type" aria-label="State" name="account_type" required>
                                            <option value=""></option>
                                            @foreach($accountTypes as $key => $accountType)
                                                <option value="{{ $key }}" @if(!empty(old('account_type') && $key == old('account_type'))) selected @endif>{{ $accountType }}</option>
                                            @endforeach
                                        </select>
                                        <label for="account_type">Tipo de conta</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="password" placeholder="" name="password" required>
                                        <label for="password">Senha</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="password_confirmation" placeholder="" name="password_confirmation" required>
                                        <label for="password_confirmation">Confirme a senha</label>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Voltar</a>
                                </div>
                            </form>
                            <!-- End floating Labels Form -->

                        </div>
                    </div>
                </div>
            </div>

        </section>

    </main><!-- End #main -->

@endsection