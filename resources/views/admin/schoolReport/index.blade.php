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
                <li class="breadcrumb-item active">Históricos escolares</li>
                {{-- <li class="breadcrumb-item active">Index</li> --}}
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section school-reports">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card pt-3">
                        <div class="card-body">
                            <div class="dataTable-top">
                                <div>
                                    <form name="FRM" action=" {{ route('admin.school-reports.index') }}" method="get">
                                        @csrf
                                        <input class="dataTable-input" placeholder="Buscar..." type="text" name="key" value="{{ app('request')->input('key') }}">
                                    </form>
                                </div>
                                <div>
                                    <a href="{{ route('admin.school-reports.create') }}" class="btn btn-primary">Novo</a>
                                </div>
                            </div>
                            <!-- Table with stripped rows -->
                            <table class="table table-striped mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Ano letivo</th>
                                        <th scope="col">Série</th>
                                        <th scope="col">Nível Escolar</th>
                                        <th scope="col">Ações</th>
                                    </tr>   
                                </thead>
                                <tbody>
                                    @foreach($schoolReports as $schoolReport)
                                        <tr>
                                            {{-- <td>{{ Carbon\Carbon::parse($schoolReport->data_coleta)->format('d/m/Y')}}</td> --}}
                                            <th scope="row">{{ $schoolReport->id }}</th>
                                            <td>{{ $schoolReport->user_name }}</td>
                                            <td>{{ $schoolReport->school_year }}</td>
                                            <td>{{ $schoolReport->school_grade_name }}</td>
                                            <td>{{ $schoolReport->school_level_name }}</td>
                                            <td>{!! \App\Http\Controllers\Admin\SchoolReportsController::actions($schoolReport->id) !!}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->
                            <div class="row">
                                <div class="col-12">
                                    {{ $schoolReports->appends(request()->except(['page']))->links('pagination.default') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

    </main><!-- End #main -->

@endsection