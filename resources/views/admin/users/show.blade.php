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
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('admin.users.index') }}">Usuários</a></li>
                <li class="breadcrumb-item active">Visualizar</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section users">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card pt-3">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Visualizar usuário</h5>

                            <!-- Floating Labels Form -->
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" placeholder="" name="name" disabled value="{{ $item->name }}">
                                        <label for="name">Nome</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="email" placeholder="" name="email" disabled value="{{ $item->email }}">
                                        <label for="email">E-mail</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="account_type" aria-label="State" name="account_type" disabled>
                                            @foreach($accountTypes as $key => $accountType)
                                                @if($key==$item->account_type)
                                                    <option selected>{{ $accountType }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <label for="account_type">Tipo de conta</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="updated_at" placeholder="" name="updated_at" disabled value="{{ Carbon\Carbon::parse($item->updated_at)->format('d/m/Y')}}">
                                        <label for="updated_at">Data de atualização</label>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Voltar</a>
                                </div>
                            </div>
                            <!-- End floating Labels Form -->

                        </div>
                    </div>
                </div>
            </div>

        </section>

    </main><!-- End #main -->

@endsection