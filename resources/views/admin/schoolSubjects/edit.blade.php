@extends('layouts.dashboard')

@include('dashboard.alerts')

@section('content')

    <main id="main" class="main">
        @yield('alerts')

        <!-- ======= Page Title ======= -->
        <div class="pagetitle">
            <h1>Matérias escolares</h1>
            <nav>
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('admin.school-subjects.index') }}">Matérias escolares</a></li>
                <li class="breadcrumb-item active">Editar</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section school-subjects">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card pt-3">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Editar matéria escolar</h5>

                            <!-- Floating Labels Form -->
                            <form class="row g-3" action="{{ route('admin.school-subjects.update', $item->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" placeholder="" name="name" required value="{{ $item->name }}">
                                        <label for="name">Nome</label>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                    <a href="{{ route('admin.school-subjects.index') }}" class="btn btn-secondary">Voltar</a>
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