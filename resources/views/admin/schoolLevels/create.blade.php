@extends('layouts.dashboard')

@include('dashboard.alerts')

@section('content')

    <main id="main" class="main">
        @yield('alerts')

        <!-- ======= Page Title ======= -->
        <div class="pagetitle">
            <h1>Níveis escolares</h1>
            <nav>
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('admin.school-levels.index') }}">Níveis escolares</a></li>
                <li class="breadcrumb-item active">Novo</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section school-levels">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card pt-3">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Novo nível escolar</h5>

                            <!-- Floating Labels Form -->
                            <form class="row g-3" action="{{ route('admin.school-levels.store') }}" method="POST">
                                @csrf
                                @method('POST')

                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" placeholder="" name="name" required value="{{ old('name') }}">
                                        <label for="name">Nome</label>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                    <a href="{{ route('admin.school-levels.index') }}" class="btn btn-secondary">Voltar</a>
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