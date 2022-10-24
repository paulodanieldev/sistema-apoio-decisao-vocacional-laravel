@extends('layouts.dashboard')

@include('dashboard.alerts')

@section('content')

    <main id="main" class="main">
        @yield('alerts')

        <!-- ======= Page Title ======= -->
        <div class="pagetitle">
            <h1>Históricos escolares</h1>
            <nav>
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('admin.school-reports.index') }}">Históricos escolares</a></li>
                <li class="breadcrumb-item active">Editar</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section school-reports">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card pt-3">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Editar histórico escolar</h5>

                            <!-- Floating Labels Form -->
                            <form class="row g-3" action="{{ route('admin.school-reports.update', $item->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="user_id" aria-label="State" name="user_id" required>
                                            <option value=""></option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}" @if($user->id==$item->user_id) selected @endif>{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="user_id">Usuário</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="school_year" placeholder="{{ date('Y') }}" name="school_year" required value="{{ $item->school_year }}">
                                        <label for="school_year">Ano letivo</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="school_grade_id" aria-label="State" name="school_grade_id" required>
                                            <option value=""></option>
                                            @foreach($schoolLevels as $schoolLevel)
                                                <option value="{{ $schoolLevel->id }}" @if($schoolLevel->id==$item->school_grade_id) selected @endif>{{ $schoolLevel->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="school_grade_id">Série</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="school_level_id" aria-label="State" name="school_level_id" required>
                                            <option value=""></option>
                                            @foreach($schoolGrades as $schoolGrade)
                                                <option value="{{ $schoolGrade->id }}" @if($schoolGrade->id==$item->school_level_id) selected @endif>{{ $schoolGrade->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="school_level_id">Nível escolar</label>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                    <a href="{{ route('admin.school-reports.index') }}" class="btn btn-secondary">Voltar</a>
                                </div>
                            </form>
                            <!-- End floating Labels Form -->

                            <!-- Component detail -->
                            <x-school-reports-grades-editable-grid :id="$item->id" :grades="$item->schoolReportsGrades" :subjects="$schoolSubjects" />

                        </div>
                    </div>
                </div>
            </div>

        </section>

    </main><!-- End #main -->

@endsection