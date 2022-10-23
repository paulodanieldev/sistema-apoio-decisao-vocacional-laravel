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
                <li class="breadcrumb-item active">Níveis escolares</li>
                {{-- <li class="breadcrumb-item active">Index</li> --}}
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section school-levels">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card pt-3">
                        <div class="card-body">
                            <div class="dataTable-top">
                                <div>
                                    <form name="FRM" action=" {{ route('admin.school-levels.index') }}" method="get">
                                        @csrf
                                        <input class="dataTable-input" placeholder="Buscar..." type="text" name="key" value="{{ app('request')->input('key') }}">
                                    </form>
                                </div>
                                <div>
                                    <a href="{{ route('admin.school-levels.create') }}" class="btn btn-primary">Novo</a>
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
                                    @foreach($schoolLevels as $schoolSubject)
                                        <tr>
                                            {{-- <td>{{ Carbon\Carbon::parse($schoolSubject->data_coleta)->format('d/m/Y')}}</td> --}}
                                            <th scope="row">{{ $schoolSubject->id }}</th>
                                            <td>{{ $schoolSubject->name }}</td>
                                            <td>{!! \App\Http\Controllers\Admin\SchoolLevelsController::actions($schoolSubject->id) !!}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->
                            <div class="row">
                                <div class="col-12">
                                    {{ $schoolLevels->appends(request()->except(['page']))->links('pagination.default') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

    </main><!-- End #main -->

@endsection