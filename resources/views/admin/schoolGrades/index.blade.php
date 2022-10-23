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
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Séries escolares</li>
                {{-- <li class="breadcrumb-item active">Index</li> --}}
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section school-grades">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card pt-3">
                        <div class="card-body">
                            <div class="dataTable-top">
                                <div>
                                    <form name="FRM" action=" {{ route('admin.school-grades.index') }}" method="get">
                                        @csrf
                                        <input class="dataTable-input" placeholder="Buscar..." type="text" name="key" value="{{ app('request')->input('key') }}">
                                    </form>
                                </div>
                                <div>
                                    <a href="{{ route('admin.school-grades.create') }}" class="btn btn-primary">Novo</a>
                                </div>
                            </div>
                            <!-- Table with stripped rows -->
                            <table class="table table-striped mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col" class="col-1">#</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col" class="col-1">Ações</th>
                                    </tr>   
                                </thead>
                                <tbody>
                                    @foreach($schoolGrades as $schoolGrade)
                                        <tr>
                                            {{-- <td>{{ Carbon\Carbon::parse($schoolGrade->data_coleta)->format('d/m/Y')}}</td> --}}
                                            <th scope="row">{{ $schoolGrade->id }}</th>
                                            <td>{{ $schoolGrade->name }}</td>
                                            <td>{!! \App\Http\Controllers\Admin\SchoolGradesController::actions($schoolGrade->id) !!}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->
                            <div class="row">
                                <div class="col-12">
                                    {{ $schoolGrades->appends(request()->except(['page']))->links('pagination.default') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

    </main><!-- End #main -->

@endsection