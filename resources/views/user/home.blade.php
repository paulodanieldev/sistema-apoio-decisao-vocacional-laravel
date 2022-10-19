@extends('layouts.app-user')

@section('content')
    <div class="container-fluid">
        
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        @if(session()->get('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Ops!</strong> Alguns erros foram encontrados.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <h1>Dashboard</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-lg-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Visitas</h5>
                        <div class="calendar"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-8 mb-4">
                {{-- <div class="row mb-5">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-1 text-center">Procedimentos</h5>
                                <p class="text-center"><i class="iconsminds-files" style="font-size: 50px;"></i>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-1 text-center">Treinamentos</h5>
                                <p class="text-center"><i class="iconsminds-student-male-female"
                                                          style="font-size: 50px;"></i></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-1 text-center">Relatórios</h5>
                                <p class="text-center"><i class="iconsminds-monitor-analytics"
                                                          style="font-size: 50px;"></i></p>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="row">
                    {{-- <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Avisos</h5>
                                <div class="scroll dashboard-logs">

                                    <table class="table table-sm table-borderless">

                                        <tbody>
                                        <tr>
                                            <td>
                                                <span class="log-indicator border-theme-1 align-middle"></span>
                                            </td>
                                            <td>
                                                <span class="font-weight-medium">Nenhum aviso encontrado.</span>
                                            </td>
                                            <td class="text-right">
                                                <span class="text-muted">{{ date('d/m H:i') }}</span>
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    {{-- <div class="col-md-8">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">Animais</h5>
                                <table class="data-table data-table-standard responsive nowrap"
                                       data-order="[[ 1, &quot;desc&quot; ]]">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Raça</th>
                                        <th>Função</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(sizeof($animais)>0)
                                    <tr>
                                        <td>
                                            <p class="list-item-heading">Marble Cake</p>
                                        </td>
                                        <td>
                                            <p class="text-muted">1452</p>
                                        </td>
                                        <td>
                                            <p class="text-muted">62</p>
                                        </td>
                                        <td>
                                            <p class="text-muted">62</p>
                                        </td>
                                    </tr>
                                    @else
                                        <tr>
                                            <td>
                                                <p class="list-item-heading">Nenhum animal cadastrado.</p>
                                            </td>
                                            <td>
                                                <p class="text-muted">-</p>
                                            </td>
                                            <td>
                                                <p class="text-muted">-</p>
                                            </td>
                                            <td>
                                                <p class="text-muted">-</p>
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
