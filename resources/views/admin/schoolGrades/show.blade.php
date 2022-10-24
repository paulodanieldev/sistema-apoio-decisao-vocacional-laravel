@extends('layouts.dashboard')

@include('dashboard.alerts')

@section('content')

    <main id="main" class="main">
        @yield('alerts')

        <!-- ======= Page Title ======= -->
        <div class="pagetitle">
            <h1>Séries escolares</h1>
            <nav>
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('admin.school-grades.index') }}">Séries escolares</a></li>
                <li class="breadcrumb-item active">Visualizar</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section school-grades">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card pt-3">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Visualizar série escolar</h5>

                            <!-- Floating Labels Form -->
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" placeholder="" name="name" disabled value="{{ $item->name }}">
                                        <label for="name">Nome</label>
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