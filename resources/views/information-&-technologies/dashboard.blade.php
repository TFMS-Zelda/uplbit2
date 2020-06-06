@extends('layouts.dashboard')
@section('title', 'information-&-technologies')

@section('content')
@section('titlePosition', 'Dashboard')
<section class="content">
    <div class="container-fluid">
        <h1 class="h3 mb-0 text-gray-800">Dashboard - information-&-technologies</h1>
        <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
                src="{{ asset('/core/undraw/dashboard-ti.svg') }}">
        </div>

        <h1 class="h3 mb-0 text-gray-800">Compañías</h1>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card bg-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                    Compañias Registradas
                                </div>
                                <div class="h4 mb-0 font-weight-bold text-white">
                                    <strong>{{ $companies }}</strong>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-laptop fa-2x text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h1 class="h3 mb-0 text-gray-800">Provedores y Articulos Registradas</h1>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card bg-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                    Provedores Registrados
                                </div>
                                <div class="h4 mb-0 font-weight-bold text-white">
                                    <strong>{{ $providers }}</strong>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-building fa-2x text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card bg-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                    Articulos Registrados
                                </div>
                                <div class="h4 mb-0 font-weight-bold text-white">
                                    <strong>{{ $articles }}</strong>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-shopping-cart fa-2x text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h1 class="h3 mb-0 text-gray-800">Configuration Item</h1>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card bg-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                    Equipos de Computo Registrados
                                </div>
                                <div class="h4 mb-0 font-weight-bold text-white">
                                    <strong>{{ $computers }}</strong> Cí
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-laptop fa-2x text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card bg-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                    Tablets Corporativas Registradas
                                </div>
                                <div class="h4 mb-0 font-weight-bold text-white">
                                    <strong>{{ $tablets }}</strong> Cí
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-tablet fa-2x text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card bg-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                    Impresoras Registradas
                                </div>
                                <div class="h4 mb-0 font-weight-bold text-white">
                                    <strong>{{ $printers }}</strong> Cí
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-print fa-2x text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card bg-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                    Monitores Registrados
                                </div>
                                <div class="h4 mb-0 font-weight-bold text-white">
                                    <strong>{{ $computers }}</strong> Cí
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-tv fa-2x text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card bg-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                    Perisfericos Regitrados
                                </div>
                                <div class="h4 mb-0 font-weight-bold text-white">
                                    <strong>{{ $peripherals }}</strong> Cí
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-asterisk fa-2x text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



</section>

@endsection