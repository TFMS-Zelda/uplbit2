@extends('layouts.dashboard')
@section('title', 'relationship-&-configurations')

@section('content')
@section('titlePosition', 'relationship-&-configurations')
<section class="content">
    <div class="container-fluid">
        <div class="text-center">

            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                src={{ asset('/core/undraw/dashboard-ti.svg') }} alt="information-&-technologies">
        </div>

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-1 text-gray-800">Relationship & Configuration </h1>
            <a href="{{ route('relationship-&-configurations.create') }}"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-location-arrow fa-sm text-white-50"></i>
                Create Relation Ci
            </a>
        </div>
        <div class="row">

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Asignación
                                    (Equipos de
                                    computo)
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $computers }} Cí <strong>VS</strong> {{ $computersAssigns }} Re
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-laptop fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Asignación
                                    (Tablets Corporativas)
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $tablets }} Cí <strong>VS</strong> {{ $tabletsAssigns }} Re
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-tablet fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>

        <div class="btn-group" role="group" aria-label="Basic example">
            <a href="{{ route('relationship-&-configurations.assignments.computers') }}"
                class="btn btn-outline-secondary btn-lg">
                <i class="fas fa-laptop"></i>
            </a>
            <a href="{{ route('relationship-&-configurations.assignments.tablets') }}"
                class="btn btn-outline-secondary btn-lg">
                <i class="fas fa-tablet"></i>
            </a>
            <a href="{{ route('relationship-&-configurations.assignments.monitors') }}"
                class="btn btn-outline-secondary btn-lg">
                <i class="fas fa-tv"></i>
            </a>
            <a href="{{ route('relationship-&-configurations.assignments.other-peripherals') }}"
                class="btn btn-outline-secondary btn-lg">
                <i class="fas fa-asterisk"></i>
            </a>
        </div>
    </div>

</section>
@endsection