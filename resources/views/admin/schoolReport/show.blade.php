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
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('admin.school-reports.index') }}">Históricos escolares</a></li>
                <li class="breadcrumb-item active">Visualizar</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section school-reports">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card pt-3">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Visualizar histórico escolar</h5>

                            <!-- Floating Labels Form -->
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="school_year" placeholder="" name="school_year" disabled value="{{ $item->school_year }}">
                                        <label for="school_year">Ano letivo</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="school_grade_id" aria-label="State" name="school_grade_id" disabled>
                                            @foreach($schoolLevels as $schoolLevel)
                                                @if($schoolLevel->id==$item->school_level_id)
                                                    <option selected>{{ $schoolLevel->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <label for="school_grade_id">Série</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="school_level_id" aria-label="State" name="school_level_id" disabled>
                                            @foreach($schoolGrades as $schoolGrade)
                                                @if($schoolGrade->id==$item->school_level_id)
                                                    <option selected>{{ $schoolGrade->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <label for="school_level_id">Nível escolar</label>
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